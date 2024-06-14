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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PengepulController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
	return redirect('/');
});

Route::get('/', [MarketController::class, 'index'])->name('market');
Route::get('products', [MarketController::class, 'products'])->name('products.shop');
Route::get('product-detail/{id_produk}', [MarketController::class, 'productDetail'])->name('product.shop.detail');
Route::get('/register', [PembeliController::class, 'create'])->name('pembeli.register');
Route::post('/register', [PembeliController::class, 'store'])->name('pembeli.register.perform');
Route::get('/login', [PembeliController::class, 'show'])->name('pembeli.login');
Route::post('/login', [PembeliController::class, 'login'])->name('pembeli.login.perform');

Route::group(['middleware' => 'pembeli'], function () {
	Route::get('/profile/{id_pembeli}', [PembeliController::class, 'edit'])->name('pembeli.profile');
	Route::put('/profile/{id_pembeli}', [PembeliController::class, 'update'])->name('pembeli.profile.update');
	Route::post('/logout', [PembeliController::class, 'logout'])->name('pembeli.logout');
	Route::get('/cart', [MarketController::class, 'cart'])->name('cart');
	Route::get('/product/{id_produk}', [MarketController::class, 'addProducttoCart'])->name('addProduct.to.cart');
	Route::put('/update-shopping-cart', [MarketController::class, 'updateCart'])->name('update.cart');
	Route::post('/delete-cart-product', [MarketController::class, 'deleteProduct'])->name('delete.cart.product');
	Route::get('/checkout', [MarketController::class, 'checkout'])->name('checkout');
	Route::post('/place-order', [MarketController::class, 'placeOrder'])->name('place.order');
	Route::get('/orders', [MarketController::class, 'showOrders'])->name('orders');
	Route::put('/orders/update-status/{order}/{status}', [MarketController::class, 'updateStatus'])->name('buyer.orders.update.status');
	Route::get('favorite/{id_produk}', [MarketController::class, 'addToFavorite'])->name('addProduct.to.favorite');
	Route::get('favorites', [MarketController::class, 'showFavorites'])->name('show.favorites');
	Route::get('remove-favorite/{id_produk}', [MarketController::class, 'removeFromFavorite'])->name('removeProduct.from.favorite');
});

// Admin
Route::prefix('admin')->group(function () {
	Route::get('/login', [AdminController::class, 'show'])->name('admin_login');
	Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');

	Route::group(['middleware' => 'admin'], function () {
		Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
		Route::post('/logout', [AdminController::class, 'logout'])->name('admin_logout');
		Route::get('/profile/{id_admin}', [AdminController::class, 'edit'])->name('admin.profile');
		Route::put('/profile/{id_admin}', [AdminController::class, 'update'])->name('admin.profile.update');
		Route::get('/orders', [AdminController::class, 'viewAllOrders'])->name('admin.viewAllOrders');
		Route::get('/{page}', [PageController::class, 'admin'])->name('admin.page'); // Updated route
	});
});

Route::prefix('stok')->group(function () {
	Route::group(['middleware' => 'guest'], function () {
		Route::get('/register', [RegisterController::class, 'create'])->name('register');
		Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');

		Route::get('/login', [LoginController::class, 'show'])->name('login');
		Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

		Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
		Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');

		Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
		Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');
	});

	Route::group(['middleware' => 'auth:web,admin'], function () {
		Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
		Route::get('/profile/{id_pengepul}', [PengepulController::class, 'editProfile'])->name('profile');
		Route::put('/profile/{id_pengepul}', [PengepulController::class, 'updateProfile'])->name('profile.update');
		Route::post('logout', [LoginController::class, 'logout'])->name('logout');

		// Product CRUD routes
		Route::get('/products', [ProductController::class, 'index'])->name('product');
		Route::get('/product-add', [ProductController::class, 'create'])->name('product-add');
		Route::post('/products', [ProductController::class, 'store'])->name('product.store');
		Route::get('/product-detail/{id_produk}', [ProductController::class, 'show'])->name('product-detail');
		Route::get('/product-edit/{id_produk}', [ProductController::class, 'edit'])->name('product.edit');
		Route::put('/product/{id_produk}', [ProductController::class, 'update'])->name('product.update');
		Route::delete('/product-delete/{id_produk}', [ProductController::class, 'destroy'])->name('product.delete');
		Route::get('/product-lacak', [ProductController::class, 'track'])->name('product.lacak');

		// Petani CRUD routes
		Route::get('/petani', [PetaniController::class, 'index'])->name('petani');
		Route::get('/petani-add', [PetaniController::class, 'create'])->name('petani-add');
		Route::post('/petani', [PetaniController::class, 'store'])->name('petani.store');
		Route::get('/petani-detail/{id_petani}', [PetaniController::class, 'show'])->name('petani-detail');
		Route::get('/petani-edit/{id_petani}', [PetaniController::class, 'edit'])->name('petani.edit');
		Route::put('/petani/{id_petani}', [PetaniController::class, 'update'])->name('petani.update');
		Route::delete('/petani-delete/{id_petani}', [PetaniController::class, 'destroy'])->name('petani.delete');

		Route::get('/pembeli', [PembeliController::class, 'daftarPembeli'])->name('pembeli.list');
		Route::get('/{id_pengepul}/orders', [ProductController::class, 'showOrders'])->name('stok.orders');
		Route::get('/{id_pengepul}/orders/exports', [ProductController::class, 'exportOrders'])->name('stok.export.orders');
		Route::get('/{id_pengepul}/produk_masuk', [ProductController::class, 'produkMasuk'])->name('stok.produk.masuk');
		Route::get('/orders/update-status/{order}/{status}', [ProductController::class, 'updateStatus'])->name('orders.update.status');
		Route::post('/mark-as-read', [PengepulController::class, 'markAsRead'])->name('markAsRead');

		// Pengepul CRUD routes
		Route::group(['middleware' => 'admin'], function () {
			Route::get('/pengepul', [PengepulController::class, 'index'])->name('pengepul');
			Route::get('/pengepul-add', [PengepulController::class, 'create'])->name('pengepul-add');
			Route::post('/pengepul', [PengepulController::class, 'store'])->name('pengepul.store');
			Route::get('/pengepul-detail/{id_pengepul}', [PengepulController::class, 'show'])->name('pengepul-detail');
			Route::get('/pengepul-edit/{id_pengepul}', [PengepulController::class, 'edit'])->name('pengepul.edit');
			Route::put('/pengepul/{id_pengepul}', [PengepulController::class, 'update'])->name('pengepul.update');
			Route::delete('/pengepul-delete/{id_pengepul}', [PengepulController::class, 'destroy'])->name('pengepul.delete');
		});


		Route::get('/{page}', [PageController::class, 'index'])->name('page');
	});
});
