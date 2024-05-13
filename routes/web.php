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

use App\Models\Petani;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PengepulController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserProfileController;

Route::get('/', function () {
	return redirect('/dashboard');
})->middleware('auth');



// Admin
Route::prefix('admin')->group(function () {
	Route::get('/login', [AdminController::class, 'show'])->name('admin_login');
	Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');

	Route::group(['middleware' => 'admin'], function () {
		Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
		Route::get('/{page}', [PageController::class, 'admin'])->name('admin.page');
		Route::post('/logout', [AdminController::class, 'logout'])->name('admin_logout');
	});
});

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');

Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('auth')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('auth')->name('reset.perform');

Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('auth')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('auth')->name('change.perform');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::group(['middleware' => 'auth:web,admin'], function () {
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

	// Petani CRUD routes
	Route::get('/petani', [PetaniController::class, 'index'])->name('petani');
	Route::get('/petani-add', [PetaniController::class, 'create'])->name('petani-add');
	Route::post('/petani', [PetaniController::class, 'store'])->name('petani.store');
	Route::get('/petani-detail/{id_petani}', [PetaniController::class, 'show'])->name('petani-detail');
	Route::get('/petani-edit/{id_petani}', [PetaniController::class, 'edit'])->name('petani.edit');
	Route::put('/petani/{id_petani}', [PetaniController::class, 'update'])->name('petani.update');
	Route::delete('/petani-delete/{id_petani}', [PetaniController::class, 'destroy'])->name('petani.delete');

	// Pengepul CRUD routes
	Route::group(['middleware' => 'admin'], function () {
		Route::get('/pengepul', [PengepulController::class, 'index'])->name('pengepul');
		Route::get('/pengepul-add', [PengepulController::class, 'create'])->name('pengepul-add');
		Route::post('/pengepul', [PengepulController::class, 'store'])->name('pengepul.store');
		Route::get('/pengepul-detail/{id_pengepul}', [PengepulController::class, 'show'])->name('pengepul-detail');
		Route::get('/pengepul-edit/{id_pengepul}', [PengepulController::class, 'edit'])->name('pengepul.edit');
		Route::put('/pengepul/{id_pengepul}', [PengepulController::class, 'update'])->name('pengepul.update');
		Route::delete('/pengepul-delete/{id_pengepul}', [PengepulController::class, 'destroy'])->name('pengepul.delete');
		Route::get('/{page}', [PageController::class, 'index'])->name('page');
	});
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
