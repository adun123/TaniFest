<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Api\ResepApiController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;
   use App\Http\Controllers\CategoryBannerController;
use App\Models\CategoryBanner;

Route::get('/', function () {
    return view('welcome');
});


Route::get('auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth','role:admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');




    Route::get('/category-banners', [CategoryBannerController::class, 'index'])->name('category-banners.index');
    Route::post('/category-banners', [CategoryBannerController::class, 'store'])->name('category-banners.store');
    Route::put('/category-banners/{categoryBanner}', [CategoryBannerController::class, 'update'])->name('category-banners.update');
    Route::delete('/category-banners/{categoryBanner}', [CategoryBannerController::class, 'destroy'])->name('category-banners.destroy');


    Route::get('/reseps', [ResepController::class, 'index'])->name('admin.reseps.index');
    Route::post('/reseps', [ResepController::class, 'store'])->name('admin.reseps.store');
    Route::delete('/reseps/{resep}', [ResepController::class, 'destroy'])->name('admin.reseps.destroy');
    Route::put('/reseps/{resep}', [ResepController::class, 'update'])->name('admin.reseps.update');     
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
    // route admin lainnya
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    // Customer Dashboard (List Produk)
    Route::get('/customer/dashboard', function (Illuminate\Http\Request $request) {
        $kategori = $request->get('kategori');
           $categories = CategoryBanner::all();
        $query = App\Models\Product::query();
    
        if ($kategori && $kategori != 'semua') {
            $query->where('category', $kategori);
        }
    
        $products = $query->latest()->get();
    
        return view('customer.dashboard', compact('products', 'categories', 'kategori'));
    })->name('customer.dashboard');
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    // Route::get('/reseps', [CustomerController::class, 'reseps'])->name('customers.reseps.index');
    // Route::get('/reseps/{id}', [CustomerController::class, 'show'])->name('customer.reseps.show');

    
    Route::get('/resep-customer', [CustomerController::class, 'reseps'])->name('customer.reseps.index');
    Route::get('/resep-customer/{id}', [CustomerController::class, 'show'])->name('customer.reseps.show');

    Route::delete('/reseps/{resep}', [ResepController::class, 'destroy'])->name('admin.reseps.destroy');
    Route::put('/reseps/{resep}', [ResepController::class, 'update'])->name('admin.reseps.update');     
    Route::get('/productlist', [CustomerController::class, 'productlist'])->name('customer.category');
    Route::get('/kategori}', [CustomerController::class, 'semuakategori'])->name('customer.category.semua');
    
    // Halaman profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Halaman alamat
    Route::put('/profile/address/{id}', [AddressController::class, 'update'])->name('profile.address.update');
    Route::delete('/profile/address/{id}', [AddressController::class, 'destroy'])->name('profile.address.destroy');
    // Halaman tambahan
    Route::post('/profile/alamat', [AddressController::class, 'store'])->name('profile.address.store');

    Route::get('/profile/privacy', [ProfileController::class, 'privacy'])->name('profile.privacy');

    // Detail Produk
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.detail');
    // Route untuk menampilkan produk berdasarkan kategori
    Route::get('/customer/product/{product}', [ProductController::class, 'show'])->name('customer.product.show');

    // Cart Routes
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add/{product}', [CartController::class, 'store'])->name('cart.store');
        Route::patch('/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/remove/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
        // web.php
        Route::post('/cart-resep/{resep}', [CartController::class, 'storeResep'])->name('cart.resep.store');

        // Halaman semua resep
        
    Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
    });
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout.store');
    // Tampilkan halaman checkout
    Route::get('/checkout', [TransactionController::class, 'checkout'])->name('checkout.index');
    // Proses pembayaran
    Route::post('/checkout/pay', [TransactionController::class, 'store'])->name('checkout.pay');
    Route::get('/checkout/success/{id}', [TransactionController::class, 'success'])->name('checkout.success');
    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');

    Route::get('/search', [CustomerController::class, 'search'])->name('customer.search');


});



require __DIR__.'/auth.php';
