<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner;

class HomeController extends Controller
{
    public function indexHome(Request $request)
    {
        $page = $request->query('page', 1);

        // Validate page number
        if (!is_numeric($page) || $page < 1 || $page > PHP_INT_MAX) {
            return redirect()->route('home.index')->with('error', 'Tham số trang không hợp lệ.');
        }

        $product = Product::getHomePageProducts(8);

        // Check if the requested page is valid within the paginated results
        if ($product->currentPage() > $product->lastPage() && $product->lastPage() > 0) {
             return redirect()->route('home.index')->with('error', 'Tham số trang không hợp lệ.');
        }

        $get6newproduct = Product::getLatestProducts(6);
        $category = Category::all();
        $manufacturer = Manufacturer::getAllManufacturers();
        $productsWithCategorys = Product::getProductsWithCategories();
        $productsWithManufacturers = Product::getProductsWithManufacturers();

        // Lấy danh sách sản phẩm yêu thích của user
        $userId = Auth::id() ?? session('id_user');
        $favoriteProductIds = [];
        if ($userId) {
            $favoriteProductIds = Favorite::where('id_user', $userId)
                ->pluck('id_product')
                ->toArray();
        }

        // Lấy 3 review 5 sao mới nhất cho trang chủ
        $topReviews = \App\Models\Review::with(['user', 'product'])
            ->where('rating', 5)
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        $topCategories = Category::getTopCategoriesByProductCount(4);

        // Add cartCount and orderCount for the authenticated user
        $cartCount = 0;
        $orderCount = 0;
        if ($userId) {
            $cartCount = \App\Models\Cart::where('id_user', $userId)->count();
            $orderCount = \App\Models\Order::where('id_user', $userId)->count();
        }

        // Lấy banner đang hiển thị
        $banners = Banner::where('status', 1)->orderByDesc('id_banner')->get();

        // Nếu là AJAX request thì trả về JSON
        if ($request->ajax()) {
            $html = view('user.partials.product_grid', [
                'products' => $product,
                'productsWithCategorys' => $productsWithCategorys,
                'productsWithManufacturers' => $productsWithManufacturers,
                'favoriteProductIds' => $favoriteProductIds
            ])->render();
            $pagination = view('user.partials.pagination', ['products' => $product])->render();
            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'currentPage' => $product->currentPage()
            ]);
        }

        return view('user.home', [
            'products' => $product,
            'newProducts' => $get6newproduct,
            'categorys' => $category,
            'manufacturers' => $manufacturer,
            'productsWithCategorys' => $productsWithCategorys,
            'productsWithManufacturers' => $productsWithManufacturers,
            'favoriteProductIds' => $favoriteProductIds,
            'topReviews' => $topReviews,
            'topCategories' => $topCategories,
            'cartCount' => $cartCount,
            'orderCount' => $orderCount,
            'banners' => $banners
        ]);
    }

    public function indexDetailProduct(Request $request)
    {
        $product = Product::findProductById($request->get('id'));
        
        if (!$product) {
            return redirect()->route('home.index')->with('error', 'Không tìm thấy sản phẩm');
        }

        $specificationArray = $product->getSpecificationsArray();
        $colors = $product->getColorsArray();
        $sizes = $product->getSizesArray();
        $manufacturer = Manufacturer::findManufacturerById($product->id_manufacturer);

        // Thêm cartCount và orderCount
        $userId = Auth::id() ?? session('id_user');
        $cartCount = 0;
        $orderCount = 0;
        if ($userId) {
            $cartCount = \App\Models\Cart::where('id_user', $userId)->count();
            $orderCount = \App\Models\Order::where('id_user', $userId)->count();
        }

        return view('user.detailproduct', [
            'specifications' => $specificationArray,
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'manufacturer' => $manufacturer,
            'cartCount' => $cartCount,
            'orderCount' => $orderCount
        ]);
    }

    public function showProductDetail($id)
    {
        $product = Product::getProductDetail($id);
        
        if (!$product) {
            return redirect()->route('home.index')->with('error', 'Không tìm thấy sản phẩm');
        }

        $colors = $product->getColorsArray();
        $sizes = $product->getSizesArray();
        $specifications = $product->getSpecificationsArray();

        // Thêm cartCount và orderCount
        $userId = Auth::id() ?? session('id_user');
        $cartCount = 0;
        $orderCount = 0;
        if ($userId) {
            $cartCount = \App\Models\Cart::where('id_user', $userId)->count();
            $orderCount = \App\Models\Order::where('id_user', $userId)->count();
        }

        return view('user.detailproduct', [
            'product' => $product,
            'colors' => $colors,
            'sizes' => $sizes,
            'specifications' => $specifications,
            'cartCount' => $cartCount,
            'orderCount' => $orderCount
        ]);
    }
}