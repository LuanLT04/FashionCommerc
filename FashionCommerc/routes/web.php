<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\ManufacturerControllerUser;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\User\ProductControllerUser;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\DetailsOrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ChatController;

// Test route for avatar dropdown
Route::get('/test-avatar', function () {
    return view('test-avatar');
});

// Test route for avatar dropdown on layout.app
Route::get('/test-avatar-app', function () {
    return view('test-avatar-app');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('dashboard', [CategoryController::class, 'dashboard']);

Route::get('dashboard', [CategoryController::class, 'dashboard']);

Route::get('category', [CategoryController::class, 'indexCategory'])->name('category.index');
Route::get('category/create', [CategoryController::class, 'indexcreateCategory'])->name('category.create');
Route::post('category', [CategoryController::class, 'createCategory'])->name('category.store');
Route::get('categoryupdate', [CategoryController::class, 'indexupdateCategory'])->name('category.updateindex');
Route::post('categoryupdate', [CategoryController::class, 'updateCategory'])->name('category.updateCategory');

    // Route xóa danh mục - Cần đảm bảo route này tồn tại
    Route::delete('category/{id}', [CategoryController::class, 'deleteCategory'])->name('category.deleteCategory');
    
    // Route xóa với AJAX (khuyên dùng)

Route::get('category/{id}/edit', [CategoryController::class, 'indexupdateCategory'])->name('category.edit');

//product
Route::get('listproduct', [ProductController::class, 'indexProduct'])->name('product.listproduct');
Route::get('addproduct', [ProductController::class, 'indexAddProduct'])->name('product.indexaddproduct');
Route::post('addproduct', [ProductController::class, 'addProduct'])->name('product.addproduct');
Route::get('deleteproduct', [ProductController::class, 'deleteProduct'])->name('product.deleteproduct');
Route::get('updateproduct', [ProductController::class, 'indexUpdateProduct'])->name('product.indexUpdateproduct');
Route::post('updateproduct', [ProductController::class, 'updateProduct'])->name('product.updateproduct');

// Register Client
Route::get('/register',[CustomerController::class,'indexRegister']);
Route::post('/register',[CustomerController::class,'authRegister'])->name('user.cus_register');

// Login client
Route::get('/login',[CustomerController::class,'indexLogin'])->name('user.indexlogin');
Route::post('/login',[CustomerController::class,'authLogin'])->name('user.cus_login');

// Logout
Route::get('/signout', [CustomerController::class, 'signOut'])->name('signout');

// List user Admin
Route::get('/listuser',[AdminUserController::class,'listUser'])->name('user.listuser');
//  Delete user admin
Route::delete('/user/{id}', [AdminUserController::class, 'deleteUser'])->name('user.deleteUser');

// Update user admin
Route::get('/updateuser',[AdminUserController::class,'updateUser'])->name('user.updateUser');
Route::post('/updateuser',[AdminUserController::class,'postUpdateUser'])->name('user.postUpdateUser');

// Block/Unblock user admin
Route::post('/user/{id}/block', [AdminUserController::class, 'blockUser'])->name('user.block');
Route::post('/user/{id}/unblock', [AdminUserController::class, 'unblockUser'])->name('user.unblock');

// List_user  Search User
Route::get('/search',[AdminUserController::class,'searchUser'])->name('user.searchUser');

Route::get('/admin/dashboard', [AdminUserController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/manufacture', [ManufacturerControllerUser::class, 'indexmanufacture'])->name('manufacture.indexmanufacture');
Route::get('/manufacturer/{id}', [ManufacturerControllerUser::class, 'showProductsByManufacturer'])->name('manufacturer.products');

//manufacturer
Route::get('listmanufacturer', [ManufacturerController::class, 'indexManufacturer'])->name('manufacturer.listmanufacturer');
Route::get('addmanufacturer', [ManufacturerController::class, 'indexAddManufacturer'])->name('manufacturer.addmanufacturer');
Route::post('addmanufacturer', [ManufacturerController::class, 'addManufacturer']);
Route::get('deletemanufacturer', [ManufacturerController::class, 'deleteManufacturer'])->name('manufacturer.deletemanufacturer');
Route::get('updatemanufacturer', [ManufacturerController::class, 'indexUpdateManufacturer'])->name('manufacturer.indexupdatemanufacturer');
Route::post('updatemanufacturer', [ManufacturerController::class, 'updateManufacturer'])->name('manufacturer.updatemanufacturer');

Route::get('detailproduct', [HomeController::class, 'indexDetailProduct'])->name('product.indexDetailproduct');

//search and filter
Route::get('/filterProduct', [ProductControllerUser::class, 'filterProduct'])->name('user.filterProduct');
Route::get('/searchProduct', [ProductControllerUser::class, 'searchProduct'])->name('user.searchProduct');

//home
Route::get('/', [HomeController::class, 'indexHome'])->name('home.index');

//add to cart
Route::post('addcard', [CartController::class, 'addCart'])->name('cart.addCard');
Route::get('mycard', [CartController::class, 'indexCard'])->name('cart.indexCart');
Route::post('mycard', [CartController::class, 'updateCart'])->name('cart.updateCart');
Route::get('deleteproductcard', [CartController::class, 'deleteProductCart'])->name('cart.deleteproductcart');
Route::get('cart/count', [CartController::class, 'getCount'])->name('cart.getCount');
Route::get('order/count', [OrderController::class, 'getCount'])->name('order.getCount');
Route::get('cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

//Bill Management
Route::get('orderindexAdmin',[AdminOrderController::class, 'orderindexAdmin'])->name('admin.orderindexAdmin');
Route::get('adminsearchorder',[AdminOrderController::class, 'adminSearchOrder'])->name('admin.adminSearchOrder');
Route::get('admindetailsorderindex',[AdminOrderController::class, 'adminDetailsOrderIndex'])->name('admin.adminDetailsOrderIndex');
Route::get('admindetailsorderdelete',[AdminOrderController::class, 'adminDetailsOrderDelete'])->name('admin.adminDetailsOrderDelete');

//payment
Route::get('myorder', [OrderController::class, 'addOrder'])->name('order.addOrder');
Route::post('myorder', [OrderController::class, 'addOrder'])->name('order.addOrder');
Route::get('detailsorder', [detailsOrderController::class, 'addDetailsOrder'])->name('detailsorder.addDetailsOrder');
Route::get('orderindex',[OrderController::class, 'orderIndex'])->name('order.orderIndex');
Route::get('detailsorderindex',[detailsOrderController::class, 'detailsOrderIndex'])->name('detailsorder.detailsOrderIndex');


//Post
Route::get('detailpost',[PostController::class, 'detailPost'])->name('post.detailpost');
Route::get('addpost',[PostController::class, 'indexAddPost'])->name('post.indexaddpost');
Route::post('addpost',[PostController::class, 'addPost'])->name('post.addpost');
Route::get('listpost',[PostController::class, 'listPost'])->name('post.listpost');
Route::get('listpostuser',[PostController::class, 'indexListPostUser'])->name('post.indexListPostUser');
Route::get('deletepost',[PostController::class, 'deletePost'])->name('post.deletepost');
Route::get('post/delete/{id}', [PostController::class, 'deletePost'])->name('post.deletePostGet');
Route::get('updatepost',[PostController::class, 'indexUpdatePost'])->name('post.indexupdatepost');
Route::post('updatepost',[PostController::class, 'updatePost'])->name('post.updatepost');
Route::post('searchpost',[PostController::class, 'searchPost'])->name('post.searchpost');

Route::get('deleteorder/{id_order}', [OrderController::class, 'deleteOrder'])->name('order.deleteOrder');

// Test loading screen
Route::get('test-loading', function() {
    return view('admin.test-loading');
})->name('admin.test-loading');

// Favorite (Yêu thích)
Route::post('/favorite/add', [ProductControllerUser::class, 'addFavorite'])->name('favorite.add');
Route::post('/favorite/remove', [ProductControllerUser::class, 'removeFavorite'])->name('favorite.remove');
Route::get('/favorite/list', [ProductControllerUser::class, 'getFavorites'])->name('favorite.list');

// API Routes for AJAX pagination
Route::get('/api/products', [ProductControllerUser::class, 'getProducts'])->name('api.products');

// Đánh giá sản phẩm
Route::get('product/{id_product}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('reviews', [ReviewController::class, 'store'])->middleware('web')->name('reviews.store');
Route::post('reviews/comment', [ReviewController::class, 'comment'])->middleware('web')->name('reviews.comment');
Route::post('reviews/like', [ReviewController::class, 'like'])->middleware('web')->name('reviews.like');
Route::post('reviews/comment/like', [ReviewController::class, 'likeComment'])->middleware('web')->name('reviews.comment.like');

Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.deleteCategoryGet');

Route::post('admin/order/update-status', [AdminOrderController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');
Route::get('admin/order/cancel', [AdminOrderController::class, 'cancelOrder'])->name('admin.order.cancel');
Route::get('admin/order/invoice/{id_order}', [AdminOrderController::class, 'printInvoice'])->name('admin.order.invoice');

// Quản lý tài khoản khách hàng
Route::middleware(['auth'])->group(function () {
    Route::get('account', [\App\Http\Controllers\User\AccountController::class, 'index'])->name('user.account');
    Route::post('account/update', [\App\Http\Controllers\User\AccountController::class, 'updateProfile'])->name('user.updateProfile');
    Route::get('account/change-password', [\App\Http\Controllers\User\AccountController::class, 'showChangePasswordForm'])->name('user.showChangePasswordForm');
    Route::post('account/change-password', [\App\Http\Controllers\User\AccountController::class, 'changePassword'])->name('user.changePassword');
    Route::get('account/finance', [\App\Http\Controllers\User\AccountFinanceController::class, 'dashboard'])->name('user.finance.dashboard');
    Route::post('account/deposit', [\App\Http\Controllers\User\AccountFinanceController::class, 'deposit'])->name('user.finance.deposit');
    Route::post('account/withdraw', [\App\Http\Controllers\User\AccountFinanceController::class, 'withdraw'])->name('user.finance.withdraw');
    Route::get('account/transactions', [\App\Http\Controllers\User\AccountFinanceController::class, 'history'])->name('user.finance.history');
});

// Quản lý phương thức thanh toán (admin)
Route::prefix('admin')->group(function () {
    Route::resource('payment-methods', PaymentMethodController::class, [
        'as' => 'admin'
    ]);
    Route::post('payment-methods/{id}/toggle', [PaymentMethodController::class, 'toggleActive'])->name('admin.payment_methods.toggle');
    Route::resource('banner', BannerController::class);
});

// About page
Route::view('/about', 'user.about')->name('about');

// Quản lý chat admin
Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('chat', [ChatController::class, 'index'])->name('admin.chat.index');
    Route::get('chat/history/{userId}', [ChatController::class, 'history'])->name('admin.chat.history');
    Route::post('chat/send/{userId}', [ChatController::class, 'send'])->name('admin.chat.send');
});

// Gửi tin nhắn từ user tới admin
Route::post('/chat/send', [App\Http\Controllers\User\ChatController::class, 'send'])->middleware('auth')->name('user.chat.send');

// Lấy lịch sử chat giữa user và admin
Route::get('/chat/history', [App\Http\Controllers\User\ChatController::class, 'history'])->middleware('auth')->name('user.chat.history');

// Lấy số tin nhắn chưa đọc từ admin
Route::get('/chat/unread-count', [App\Http\Controllers\User\ChatController::class, 'unreadCount'])->middleware('auth')->name('user.chat.unreadCount');



