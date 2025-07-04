<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function indexProduct(Request $request) {
        try {
            $page = $request->query('page', 1);
            $search = $request->get('search');

            // Validate page parameter
            if (!is_numeric($page) || $page < 1) {
                return redirect()->route('product.listproduct')
                    ->with('error', 'Tham số trang không hợp lệ');
            }

            // Get products with search functionality
            if ($search) {
                // Tìm kiếm sản phẩm theo tên, sắp xếp theo mới nhất
                $products = Product::where('name_product', 'LIKE', '%' . $search . '%')
                                  ->orderBy('created_at', 'desc')
                                  ->orderBy('id_product', 'desc')
                                  ->paginate(6);

                // Get total for search results
                $totalProducts = Product::where('name_product', 'LIKE', '%' . $search . '%')->count();
            } else {
                // Get total number of products first
                $totalProducts = Product::count();
                $perPage = 6;
                $lastPage = ceil($totalProducts / $perPage);

                // Check if requested page exceeds total pages
                if ($page > $lastPage && $lastPage > 0) {
                    return redirect()->route('product.listproduct')
                        ->with('error', 'Trang không tồn tại');
                }

                // Lấy tất cả sản phẩm với phân trang, sắp xếp theo mới nhất
                $products = Product::getProductsWithPagination(6);
            }

            $category = Category::all();
            $manufacturer = Manufacturer::getAllManufacturers();
            return view('admin.product.listproduct', [
                'products' => $products,
                'categorys' => $category,
                'manufacturers' => $manufacturer,
                'search' => $search
            ]);
        } catch (\Exception $e) {
            return redirect()->route('product.listproduct')
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function indexAddProduct(){
        $category = Category::all();
        $manufacturer = Manufacturer::getAllManufacturers();
        return view('admin.product.addproduct', [
            'categorys' => $category,
            'manufacturers' => $manufacturer
        ]);
    }
    
    private function validateInput($data) {
        // Check for whitespace-only input
        $textFields = ['name_product', 'describe_product', 'specifications'];
        foreach ($textFields as $field) {
            if (isset($data[$field]) && trim($data[$field]) === '') {
                return false;
            }
        }

        // Check for full-width characters
        $fullWidthPattern = '/[\x{3000}-\x{303F}\x{FF00}-\x{FFEF}]/u';
        foreach ($textFields as $field) {
            if (isset($data[$field]) && preg_match($fullWidthPattern, $data[$field])) {
                return false;
            }
        }

        return true;
    }

    private function validateImage($file) {
        // Check file extension
        $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif'];
        $extension = strtolower($file->getClientOriginalExtension());
        
        if (!in_array($extension, $allowedExtensions)) {
            return false;
        }

        // Check file size (2MB max)
        if ($file->getSize() > 2 * 1024 * 1024) {
            return false;
        }

        // Check if file is actually an image
        if (!getimagesize($file->getPathname())) {
            return false;
        }

        return true;
    }

    public function addProduct(Request $request){
        // Validate the request
        $validator = Validator::make($request->all(), Product::$rules, Product::$messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Validate whitespace and full-width characters
        if (!$this->validateInput($data)) {
            return redirect()->back()
                ->with('error', 'Không được phép nhập toàn khoảng trắng hoặc ký tự full-width')
                ->withInput();
        }

        // Handle image upload
        if($request->hasFile('image_address_product')) {
            $file = $request->file('image_address_product');
            
            // Validate image
            if (!$this->validateImage($file)) {
                return redirect()->back()
                    ->with('error', 'File không phải là hình ảnh hợp lệ hoặc kích thước quá lớn')
                    ->withInput();
            }

            $ex = $file->getClientOriginalExtension();
            $filename = time().'.'.$ex;
            $file->move('uploads/productimage/',$filename);
            $data['image_address_product'] = $filename;
        }

        try {
            // Create new product
            Product::createProduct([
                'selected_category' => $data['id_category'],
                'selected_manufacturer' => $data['id_manufacturer'],
                'name_product' => $data['name_product'],
                'quantity_product' => $data['quantity_product'],
                'price_product' => $data['price_product'],
                'image_address_product' => $data['image_address_product'],
                'describe_product' => $data['describe_product'],
                'specifications' => $data['specifications'] ?? null,
                'sizes' => $data['sizes'] ?? null,
                'colors' => $data['colors'] ?? null,
            ]);

            return redirect()->route('product.listproduct')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            // If image was uploaded but product creation failed, delete the image
            if (isset($data['image_address_product'])) {
                $image_path = 'uploads/productimage/' . $data['image_address_product'];
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi thêm sản phẩm: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function deleteProduct(Request $request){
        try {
            $product = Product::findProductById($request->get('id'));
            
            if (!$product) {
                return redirect()->back()
                    ->with('error', 'Không tìm thấy sản phẩm để xóa');
            }

            // Delete the product image if it exists
            if ($product->image_address_product) {
                $image_path = 'uploads/productimage/' . $product->image_address_product;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            // Use transaction to ensure atomicity
            DB::beginTransaction();
            try {
                Product::destroy($request->get('id'));
                DB::commit();
                return redirect()->route('product.listproduct')
                    ->with('success', 'Xóa sản phẩm thành công');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Có lỗi xảy ra khi xóa sản phẩm: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi xóa sản phẩm: ' . $e->getMessage());
        }
    }

    public function indexUpdateProduct(Request $request){
        try {
            $id = $request->get('id');
            
            // Validate ID format
            if (!is_numeric($id)) {
                return redirect()->route('product.listproduct')
                    ->with('error', 'ID sản phẩm không hợp lệ');
            }

            $product = Product::findProductById($id);
            $category = Category::all();
            $manufacturer = Manufacturer::getAllManufacturers();
            
            if (!$product) {
                return redirect()->route('product.listproduct')
                    ->with('error', 'Không tìm thấy sản phẩm với ID: ' . $id);
            }

            return view('admin.product.updateproduct', [
                'products' => $product,
                'categorys' => $category,
                'manufacturers' => $manufacturer
            ]);
        } catch (\Exception $e) {
            return redirect()->route('product.listproduct')
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    
    public function updateProduct(Request $request){
        // Define validation rules specifically for update, making image optional
        $updateRules = Product::$rules;
        $updateRules['image_address_product'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';

        // Sử dụng rules giống như khi thêm mới
        $validator = Validator::make($request->all(), $updateRules, Product::$messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Validate whitespace and full-width characters
        if (!$this->validateInput($data)) {
            return redirect()->back()
                ->with('error', 'Không được phép nhập toàn khoảng trắng hoặc ký tự full-width')
                ->withInput();
        }
        
        try {
            DB::beginTransaction();
            
            $product = Product::findProductById($data['id']);
            if (!$product) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Không tìm thấy sản phẩm để cập nhật. Có thể sản phẩm đã bị xóa ở nơi khác.')
                    ->withInput();
            }

            // Check if product was modified by another user
            if ($product->updated_at != $request->input('updated_at')) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Sản phẩm đã được cập nhật bởi người dùng khác. Vui lòng tải lại trang và thử lại.')
                    ->withInput();
            }

            // Handle image update
            if($request->hasFile('image_address_product')) {
                $file = $request->file('image_address_product');
                
                // Validate image
                if (!$this->validateImage($file)) {
                    DB::rollBack();
                    return redirect()->back()
                        ->with('error', 'File không phải là hình ảnh hợp lệ hoặc kích thước quá lớn')
                        ->withInput();
                }

                // Xóa ảnh cũ
                $image_cu = 'uploads/productimage/' . $product->image_address_product;
                if(File::exists($image_cu)) {
                    File::delete($image_cu);
                }
                
                // Upload ảnh mới
                $ex = $file->getClientOriginalExtension();
                $filename = time().'.'.$ex;
                $file->move('uploads/productimage/',$filename);
                $data['image_address_product'] = $filename;
            } else {
                // Keep existing image if no new image is uploaded
                $data['image_address_product'] = $product->image_address_product;
            }

            // Update product
            Product::updateProductById($data['id'], [
                'selected_category' => $data['id_category'],
                'selected_manufacturer' => $data['id_manufacturer'],
                'name_product' => $data['name_product'],
                'quantity_product' => $data['quantity_product'],
                'price_product' => $data['price_product'],
                'describe_product' => $data['describe_product'],
                'specifications' => $data['specifications'] ?? null,
                'sizes' => $data['sizes'] ?? null,
                'colors' => $data['colors'] ?? null,
                'image_address_product' => $data['image_address_product'],
            ]);

            DB::commit();
            return redirect()->route('product.listproduct')
                ->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            // Nếu upload ảnh mới mà lỗi thì xóa ảnh mới
            if (isset($data['image_address_product']) && $request->hasFile('image_address_product')) {
                $image_path = 'uploads/productimage/' . $data['image_address_product'];
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }

            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi cập nhật sản phẩm: ' . $e->getMessage())
                ->withInput();
        }
    }
}