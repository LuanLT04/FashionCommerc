<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function indexCategory(Request $request){
        $categories = \App\Models\Category::orderBy('id_category', 'desc')->paginate(10);
        return view('admin.category.categoryIndex', ['categories' => $categories]);
    }

    public function indexcreateCategory(){
        return view('admin.category.categoryCreateIndex');
    }
    
    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:100|unique:categories,name_category',
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.min' => 'Tên danh mục phải có ít nhất 2 ký tự',
            'name.max' => 'Tên danh mục không quá 100 ký tự',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'image_category.image' => 'File phải là hình ảnh',
            'image_category.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image_category.max' => 'Kích thước hình ảnh không được vượt quá 2MB'
        ]);

        try {
            // Tạo thư mục nếu chưa có
            $uploadPath = public_path('uploads/categoryimage');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $data = [
                'name_category' => trim($request->name)
            ];

            // Xử lý upload ảnh nếu có
            if ($request->hasFile('image_category')) {
                $image = $request->file('image_category');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                if ($image->move($uploadPath, $imageName)) {
                    $data['image_category'] = $imageName;
                }
            }

            $category = \App\Models\Category::create($data);

            if ($category) {
                return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công!');
            } else {
                return redirect()->back()->with('error', 'Không thể tạo danh mục')->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
        }
    }

    public function indexupdateCategory($id)
    {
        $cate = \App\Models\Category::where('id_category', $id)->first();
        if (!$cate) {
            abort(404, 'Không tìm thấy danh mục');
        }
        return view('admin.category.categoryUpdateIndex', ['category' => $cate]);
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.max' => 'Tên danh mục không quá 255 ký tự',
            'image_category.image' => 'File phải là hình ảnh',
            'image_category.mimes' => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif',
            'image_category.max' => 'Kích thước hình ảnh không được vượt quá 2MB'
        ]);

        try {
            $category = Category::where('id_category', $request->id)->first();

            if (!$category) {
                return redirect()->back()->with('error', 'Không tìm thấy danh mục');
            }

            // Cập nhật tên danh mục (kể cả khi không đổi)
            $category->name_category = $request->name;

            // Nếu có file ảnh mới thì cập nhật, không thì giữ nguyên ảnh cũ
            if ($request->hasFile('image_category')) {
                // Xóa ảnh cũ nếu có
                if ($category->image_category && file_exists(public_path('uploads/categoryimage/' . $category->image_category))) {
                    unlink(public_path('uploads/categoryimage/' . $category->image_category));
                }

                $image = $request->file('image_category');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/categoryimage'), $imageName);
                $category->image_category = $imageName;
            }

            $category->save();
            return redirect()->route('category.index')->with('success', 'Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteCategory($id)
    {
        \Log::info('Đã gọi hàm xóa danh mục', ['id' => $id]);
        try {
            $category = Category::where('id_category', $id)->first();
            if (!$category) {
                return redirect()->route('category.index')->with('error', 'Không tìm thấy danh mục cần xóa');
            }
            // Xóa ảnh nếu có
            if ($category->image_category && file_exists(public_path('uploads/categoryimage/' . $category->image_category))) {
                unlink(public_path('uploads/categoryimage/' . $category->image_category));
            }
            $deleted = $category->delete();
            if ($deleted) {
                return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công!');
            } else {
                return redirect()->route('category.index')->with('error', 'Không thể xóa danh mục');
            }
        } catch (\Exception $e) {
            \Log::error('Error deleting category: ' . $e->getMessage());
            return redirect()->route('category.index')->with('error', 'Có lỗi xảy ra khi xóa danh mục: ' . $e->getMessage());
        }
    }
    
    // Phương thức xóa có xác nhận (khuyên dùng)
    public function deleteCategoryConfirm($id)
    {
        try {
            $category = Category::where('id_category', $id)->first();

            if (!$category) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy danh mục']);
            }

            // Kiểm tra sản phẩm liên quan
            $productCount = $category->products()->count();
            
                if ($productCount > 0) {
                return response()->json([
                    'success' => false, 
                    'message' => "Không thể xóa danh mục vì còn {$productCount} sản phẩm thuộc danh mục này."
                ]);
            }

            // Xóa ảnh nếu có
            if ($category->image_category && file_exists(public_path('uploads/categoryimage/' . $category->image_category))) {
                unlink(public_path('uploads/categoryimage/' . $category->image_category));
            }

            $deleted = $category->delete();

            if ($deleted) {
                return response()->json(['success' => true, 'message' => 'Xóa danh mục thành công!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Không thể xóa danh mục']);
            }
            
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
}
