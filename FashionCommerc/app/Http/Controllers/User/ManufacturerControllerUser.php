<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use App\Models\Product;

class ManufacturerControllerUser extends Controller
{
    public function indexmanufacture()
    {
        $manufacturers = Manufacturer::all();
        return view('user.manufacturer', compact('manufacturers'));
    }

    public function showProductsByManufacturer($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);

        $page = request()->query('page', 1);

        // Validate page number
        if (!is_numeric($page) || $page < 1 || $page > PHP_INT_MAX) {
            return redirect()->route('manufacturer.products', ['id' => $id])->with('error', 'Tham số trang không hợp lệ.');
        }

        $products = Product::where('id_manufacturer', $id)->paginate(6);

        // Check if the requested page is valid within the paginated results
        if ($products->currentPage() > $products->lastPage() && $products->lastPage() > 0) {
             return redirect()->route('manufacturer.products', ['id' => $id])->with('error', 'Tham số trang không hợp lệ.');
        }

        // Thêm cartCount và orderCount
        $user = auth()->user();
        $cartCount = 0;
        $orderCount = 0;
        if ($user) {
            $cartCount = \App\Models\Cart::where('id_user', $user->id_user)->count();
            $orderCount = \App\Models\Order::where('id_user', $user->id_user)->count();
        }

        return view('user.products_by_manufacturer', [
            'manufacturer' => $manufacturer,
            'products' => $products,
            'cartCount' => $cartCount,
            'orderCount' => $orderCount
        ]);
    }
}
