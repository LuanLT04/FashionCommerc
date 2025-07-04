<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use Illuminate\Support\Facades\DB;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class ProductControllerUser extends Controller
{
    public function searchProduct(Request $request)
    {
        $keyword = $request->input('keyword');

        // Kiểm tra nếu không có từ khóa tìm kiếm
        if (!$keyword) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa để tìm kiếm.');
        }

        $page = $request->query('page', 1);

        // Validate page number
        if (!is_numeric($page) || $page < 1 || $page > PHP_INT_MAX) {
            return redirect()->route('user.searchProduct', ['keyword' => $keyword])->with('error', 'Tham số trang không hợp lệ.');
        }

        // Tìm kiếm sản phẩm chỉ theo tên
        $products = Product::where('name_product', 'LIKE', '%' . $keyword . '%')
                          ->paginate(4);

        // Check if the requested page is valid within the paginated results
        if ($products->currentPage() > $products->lastPage() && $products->lastPage() > 0) {
             return redirect()->route('user.searchProduct', ['keyword' => $keyword])->with('error', 'Tham số trang không hợp lệ.');
        }

        // Lấy danh mục và hãng sản xuất để hiển thị trong bộ lọc
        $categories = Category::all();
        $manufacturers = Manufacturer::all();

        // Lấy cartCount và orderCount cho user đang đăng nhập (nếu có)
        $cartCount = 0;
        $orderCount = 0;
        $userId = Auth::id() ?? session('id_user');
        if ($userId) {
            $cartCount = \App\Models\Cart::where('id_user', $userId)->count();
            $orderCount = \App\Models\Order::where('id_user', $userId)->count();
        }
        return view('user.searchProduct', compact('products', 'categories', 'manufacturers', 'keyword', 'cartCount', 'orderCount'));
    }

    public function filterProduct(Request $request)
    {
        // Lấy tất cả tham số lọc
        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $manufacturer = $request->input('manufacturer');
        $price_min = $request->input('price_min');
        $price_max = $request->input('price_max');
        $purchased_min = $request->input('purchased_min');
        $purchased_max = $request->input('purchased_max');
        $sort = $request->input('sort', 'newest'); // Thêm sắp xếp
        
        // Khởi tạo query
        $query = Product::query();
        
        // Tìm kiếm theo keyword nếu có - chỉ tìm theo tên sản phẩm
        if (!empty($keyword)) {
            $query->where('name_product', 'like', '%' . $keyword . '%');
        }
        
        // Lọc theo danh mục
        if (!empty($category)) {
            $query->where('id_category', $category);
        }
        
        // Lọc theo nhà sản xuất
        if (!empty($manufacturer)) {
            $query->where('id_manufacturer', $manufacturer);
        }
        
        // Lọc theo khoảng giá
        if (!empty($price_min)) {
            $query->where('price_product', '>=', $price_min);
        }
        
        if (!empty($price_max)) {
            $query->where('price_product', '<=', $price_max);
        }
        
        // Lọc theo số lượt mua
        if (!empty($purchased_min)) {
            $query->where('purchased', '>=', $purchased_min);
        }
        
        if (!empty($purchased_max)) {
            $query->where('purchased', '<=', $purchased_max);
        }

        // Sắp xếp sản phẩm
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price_product', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price_product', 'desc');
                break;
            case 'purchased':
                $query->orderBy('purchased', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        // Thực hiện truy vấn với phân trang
        $products = $query->paginate(12);
        
        // Lấy danh sách danh mục và nhà sản xuất cho bộ lọc
        $categories = Category::all();
        $manufacturers = Manufacturer::all();

        // Lấy cartCount và orderCount cho user đang đăng nhập (nếu có)
        $cartCount = 0;
        $orderCount = 0;
        $userId = Auth::id() ?? session('id_user');
        if ($userId) {
            $cartCount = \App\Models\Cart::where('id_user', $userId)->count();
            $orderCount = \App\Models\Order::where('id_user', $userId)->count();
        }

        return view('user.searchProduct', compact(
            'products', 
            'categories', 
            'manufacturers', 
            'keyword',
            'sort',
            'cartCount',
            'orderCount'
        ));
    }

    public function getProducts(Request $request)
    {
        $products = Product::with(['category', 'manufacturer'])->paginate(12);
        $userId = Auth::id() ?? session('id_user');
        
        // Lấy danh sách sản phẩm yêu thích của user
        $favoriteProductIds = [];
        if ($userId) {
            $favoriteProductIds = Favorite::where('id_user', $userId)
                ->pluck('id_product')
                ->toArray();
        }
        
        $html = view('user.partials.product_grid', [
            'products' => $products,
            'productsWithCategorys' => Category::all(),
            'productsWithManufacturers' => Manufacturer::all(),
            'favoriteProductIds' => $favoriteProductIds
        ])->render();
        
        return response()->json([
            'html' => $html,
            'lastPage' => $products->lastPage(),
            'currentPage' => $products->currentPage(),
            'total' => $products->total()
        ]);
    }

    // Thêm sản phẩm vào yêu thích
    public function addFavorite(Request $request)
    {
        $userId = Auth::id() ?? session('id_user');
        $productId = $request->input('id_product');
        if (!$userId || !$productId) {
            return response()->json(['success' => false, 'message' => 'Thiếu thông tin!'], 400);
        }
        $exists = Favorite::where('id_user', $userId)->where('id_product', $productId)->exists();
        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Đã có trong yêu thích!'], 409);
        }
        Favorite::create(['id_user' => $userId, 'id_product' => $productId]);
        return response()->json(['success' => true, 'message' => 'Đã thêm vào yêu thích!']);
    }

    // Xóa sản phẩm khỏi yêu thích
    public function removeFavorite(Request $request)
    {
        $userId = Auth::id() ?? session('id_user');
        $productId = $request->input('id_product');
        if (!$userId || !$productId) {
            return response()->json(['success' => false, 'message' => 'Thiếu thông tin!'], 400);
        }
        Favorite::where('id_user', $userId)->where('id_product', $productId)->delete();
        return response()->json(['success' => true, 'message' => 'Đã xóa khỏi yêu thích!']);
    }

    // Lấy danh sách sản phẩm yêu thích của user
    public function getFavorites(Request $request)
    {
        $userId = Auth::id() ?? session('id_user');
        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'Chưa đăng nhập!'], 401);
        }
        $favorites = Favorite::with('product')->where('id_user', $userId)->get();
        return response()->json(['success' => true, 'favorites' => $favorites]);
    }
}