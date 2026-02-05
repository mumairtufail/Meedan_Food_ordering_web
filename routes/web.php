<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/menu', [PublicController::class, 'menu'])->name('menu');
Route::get('/menu/{product:slug}', [PublicController::class, 'product'])->name('product.show');
Route::get('/deals', [PublicController::class, 'deals'])->name('deals');
Route::get('/deals/{deal}', [PublicController::class, 'deal'])->name('deal.show');
Route::get('/categories', [PublicController::class, 'categories'])->name('categories');
Route::get('/reservation', [PublicController::class, 'reservation'])->name('reservation');
Route::post('/reservation', [PublicController::class, 'storeReservation'])->name('reservation.store');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'storeContact'])->name('contact.store');

Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/add-deal/{deal}', [App\Http\Controllers\CartController::class, 'addDeal'])->name('cart.add-deal');

// Customer Auth Routes
Route::post('/customer/login', [\App\Http\Controllers\CustomerAuthController::class, 'login'])->name('customer.login');
Route::post('/customer/register', [\App\Http\Controllers\CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/logout', [\App\Http\Controllers\CustomerAuthController::class, 'logout'])->name('customer.logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::patch('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    Route::resource('categories', CategoryController::class);
    
    Route::patch('/products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::resource('products', ProductController::class);

    Route::resource('customers', \App\Http\Controllers\CustomerController::class)->only(['index']);
    
    Route::patch('/deals/{deal}/toggle-status', [\App\Http\Controllers\DealController::class, 'toggleStatus'])->name('deals.toggle-status');
    Route::resource('deals', \App\Http\Controllers\DealController::class);
    
    Route::patch('/addons/{addon}/toggle-status', [\App\Http\Controllers\AddonController::class, 'toggleStatus'])->name('addons.toggle-status');
    Route::resource('addons', \App\Http\Controllers\AddonController::class);

    Route::resource('contacts', \App\Http\Controllers\Admin\ContactManagementController::class)->only(['index', 'show', 'destroy']);
    Route::resource('reservations', \App\Http\Controllers\Admin\ReservationManagementController::class);
    
    Route::get('/orders', function () {
        return view('admin.orders.coming-soon');
    })->name('orders.index');

    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';

// ==========================================
// UTILITY ROUTES FOR SHARED HOSTING STORAGE
// ==========================================

// 1. Route to CREATE the storage link
Route::get('/storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    if (file_exists($link)) {
        return 'The "public/storage" path already exists. If your images are still not loading, try "<b>/storage-unlink</b>" first, then run this again.';
    }

    try {
        symlink($target, $link);
        return 'SUCCESS: Storage link created. Your images should be visible now.';
    } catch (\Throwable $e) {
        return 'ERROR: Failed to create link: ' . $e->getMessage();
    }
});

// 2. Route to REMOVE the storage link (if you need to reset)
Route::get('/storage-unlink', function () {
    $link = public_path('storage');

    if (!file_exists($link)) {
        return 'The "public/storage" path does not exist, so there is nothing to remove.';
    }

    try {
        if (is_link($link)) {
            unlink($link);
            return 'SUCCESS: Storage symlink has been removed. You can now run "<b>/storage-link</b>" to recreate it.';
        }
        
        // Handle case where it's a real directory
        if (is_dir($link)) {
            $backupName = 'storage_backup_' . time();
            $backupPath = public_path($backupName);
            
            if (rename($link, $backupPath)) {
                return "SUCCESS: The existing 'public/storage' was a REAL DIRECTORY. It has been renamed to '<b>{$backupName}</b>' to preserve your data. You can now run '<b>/storage-link</b>' to correct the issue.";
            }

            return 'ERROR: "public/storage" is a real directory and could not be renamed automatically. Please rename it manually in cPanel File Manager.';
        }

        unlink($link); 
        return 'SUCCESS: Storage file removed.';
    } catch (\Throwable $e) {
        return 'ERROR: Failed to remove link: ' . $e->getMessage();
    }
});
