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
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login.form');
})->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// =================user=========================
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/home', [UserHomeController::class, 'index'])->name('user.home');
    Route::get('/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::get('/shop', [ShopController::class, 'index'])->name('user.shop');
    Route::get('/cart', [CartController::class, 'index'])->name('user.cart');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('user.cart.update');
    Route::put('/cart/ajax-update/{id}', [CartController::class, 'ajaxUpdate'])->name('user.cart.ajaxUpdate');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('user.cart.remove');
    Route::post('/cart/add', [CartController::class, 'add'])->name('user.cart.add');
    Route::get('/contact', [ContactController::class, 'index'])->name('user.contact');
    Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
    Route::get('/blog', function () {
        return view('user.blog');
    })->name('user.blog');
});

// Route shop public (không cần đăng nhập)
Route::get('/shop', [ShopController::class, 'index'])->name('user.shop');

// =================admin=========================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Category
    Route::get('/category', [AdminCategoryController::class, 'index'])->name('admin.category');
    Route::post('/category', [AdminCategoryController::class, 'store'])->name('admin.category.store');
    Route::put('/category/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/category/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.category.destroy');

    // User
    Route::get('/user', [AdminUserController::class, 'index'])->name('admin.user');
    Route::put('/user/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/{id}', [AdminUserController::class, 'destroy'])->name('admin.user.destroy');

    // Order
    Route::get('/order', [AdminOrderController::class, 'index'])->name('admin.order');
    Route::put('/order/{id}', [AdminOrderController::class, 'update'])->name('admin.order.update');
    Route::delete('/order/{id}', [AdminOrderController::class, 'destroy'])->name('admin.order.destroy');

    // Product
    Route::get('/product', [AdminProductController::class, 'index'])->name('admin.product');
    Route::post('/product', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::put('/product/{id}', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/product/{id}', [AdminProductController::class, 'destroy'])->name('admin.product.destroy');

    // Notification
    Route::get('/notification', [NotificationController::class, 'index'])->name('admin.notification');
    Route::post('/contact-replies', [NotificationController::class, 'storeReply'])->name('contact-replies.store');
});


// Route::get('/admin/layout', function () {
//     return view('admin.layout');
// })->name('admin.layout');





