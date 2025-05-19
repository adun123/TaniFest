<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

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
    

Route::get('/customer/reseps/{id}', [ResepController::class, 'show'])->name('customer.reseps.show');

    Route::get('/reseps', [ResepController::class, 'index'])->name('reseps.index');
    Route::post('/reseps', [ResepController::class, 'store'])->name('reseps.store');
    Route::delete('/reseps/{resep}', [ResepController::class, 'destroy'])->name('admin.reseps.destroy');
    Route::put('/reseps/{resep}', [ResepController::class, 'update'])->name('reseps.update');     
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');
    // route admin lainnya
});

Route::middleware(['auth', 'role:customer'])->group(function () {
    // Customer Dashboard (List Produk)
    Route::get('/customer/dashboard', function (Illuminate\Http\Request $request) {
        $kategori = $request->get('kategori');
    
        $query = App\Models\Product::query();
    
        if ($kategori && $kategori != 'semua') {
            $query->where('category', $kategori);
        }
    
        $products = $query->latest()->get();
    
        return view('customer.dashboard', compact('products'));
    })->name('customer.dashboard');
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');

    Route::get('/kategori', [CustomerController::class, 'category'])->name('customer.category');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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

        // Halaman semua resep
Route::get('/reseps', [CustomerController::class, 'reseps'])->name('reseps.index');
Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');
    });

});



require __DIR__.'/auth.php';
