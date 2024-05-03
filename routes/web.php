<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserProfileController;

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('auth')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('auth')->name('reset.perform');

Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('auth')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('auth')->name('change.perform');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');

	// Product CRUD routes
	Route::get('/products', [ProductController::class, 'index'])->name('product');
	Route::get('/product-add', [ProductController::class, 'create'])->name('product-add');
	Route::post('/products', [ProductController::class, 'store'])->name('product.store');
	Route::get('/product-detail/{id_produk}', [ProductController::class, 'show'])->name('product-detail');
	Route::get('/product-edit/{id_produk}', [ProductController::class, 'edit'])->name('product.edit');
	Route::put('/product/{id_produk}', [ProductController::class, 'update'])->name('product.update');
	Route::delete('/product-delete/{id_produk}', [ProductController::class, 'destroy'])->name('product.delete');
	Route::get('/product-deleted-list', [ProductController::class, 'deletedProduct']);
	Route::get('/product/{id}/restore', [ProductController::class, 'restore']);


	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


Route::get('/admin/{page}', [PageController::class, 'admin'])->name('admin.page');


// Admin
Route::middleware('admin')->prefix('admin')->group(function () {
	Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
});

Route::get('admin/login', [AdminController::class, 'show'])->name('admin_login');
Route::post('admin/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
