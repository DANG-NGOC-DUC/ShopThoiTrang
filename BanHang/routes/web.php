<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// ============login, logout, register=================
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/user/home', function () {
    return view('user.home');
})->name('user.home');

Route::get('/admin/user', function () {
    return view('admin.user');
})->name('admin.user');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login.form');
})->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


// =================user=========================
Route::get('/user/shop', function () {
    return view('user.shop');
})->name('user.shop');

Route::get('/user/home', [UserHomeController::class, 'index'])->name('user.home');
Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::put('/user/profile/{id}', [ProfileController::class, 'update'])->name('user.profile.update');
});

//===================user cart=========================
Route::get('/user/cart', [CartController::class, 'index'])->name('user.cart');
Route::put('/user/cart/{id}', [CartController::class, 'update'])->name('user.cart.update');
Route::put('/user/cart/ajax-update/{id}', [CartController::class, 'ajaxUpdate'])->name('user.cart.ajaxUpdate');

Route::delete('/user/cart/{id}', [CartController::class, 'remove'])->name('user.cart.remove');

Route::post('/user/cart/add', [CartController::class, 'add'])->name('user.cart.add');

Route::get('/user/contact', [ContactController::class, 'index'])->name('user.contact');
Route::post('/user/contact', [ContactController::class, 'submit'])->name('contact.submit');



Route::get('/shop', [ShopController::class, 'index'])->name('user.shop');


Route::get('/user/blog', function () {
    return view('user.blog');
})->name('user.blog');


// =================admin=========================
// Route admin category
Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('admin.category');
Route::put('/admin/category/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update'); // hoặc admin.user.update
Route::delete('/admin/category/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');
Route::post('/admin/category', [AdminCategoryController::class, 'store'])->name('admin.category.store');


// Route admin user
Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.user');
Route::put('/admin/user/{id}', [AdminUserController::class, 'update'])->name('admin.user.update'); // hoặc admin.user.update
Route::delete('/admin/user/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');

// Route admin order
Route::get('/admin/order', [AdminOrderController::class, 'index'])->name('admin.order');
Route::put('/admin/order/{id}', [AdminOrderController::class, 'update'])->name('admin.order.update'); 
Route::delete('/admin/order/{id}', [AdminOrderController::class, 'destroy'])->name('admin.order.destroy');

// Route admin product
Route::get('/admin/product', [AdminProductController::class, 'index'])->name('admin.product');
Route::put('/admin/product/{id}', [AdminProductController::class, 'update'])->name('admin.product.update'); 
Route::delete('/admin/product/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');
Route::post('/admin/product', [AdminProductController::class, 'store'])->name('admin.product.store');

//Route admin notification
Route::post('/admin/contact-replies', [NotificationController::class, 'storeReply'])->name('contact-replies.store');

Route::get('/admin/notification', [NotificationController::class, 'index'])->name('admin.notification');

// Route admin dashboard
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});







// Route::get('/admin/layout', function () {
//     return view('admin.layout');
// })->name('admin.layout');





