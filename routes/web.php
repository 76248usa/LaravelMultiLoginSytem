<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;

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

/*---------ADMIN ROUTES----------- */
Route::prefix('admin')->group(function(){
Route::get('/login', [AdminController::class, 'Index'])->name('login_form');
Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
Route::get('/dashboard', [AdminController::class, 'Dashboard'])
->name('admin.dashboard')->middleware('admin');
Route::get('/logout', [AdminController::class, 'AdminLogout'])
->name('admin.logout')->middleware('admin');
Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
Route::post('/register/store', [AdminController::class, 'AdminRegisterStore'])->name('admin.store');
});
/*---------END ADMIN ROUTES----------- */

/*---------SELLER ROUTES----------- */
Route::prefix('seller')->group(function(){
    Route::get('/login', [SellerController::class, 'Index'])->name('seller_login');
    Route::post('/login/owner', [SellerController::class, 'SellerCheck'])->name('seller.check');
    Route::get('/dashboard', [SellerController::class, 'SellerDashboard'])
    ->name('seller.dashboard')->middleware('seller');
    Route::get('/logout', [SellerController::class, 'SellerLogout'])
    ->name('seller.logout')->middleware('seller');
    Route::get('/register', [SellerController::class, 'SellerRegister'])->name('seller.register');
    Route::post('/register/store', [SellerController::class, 'SellerRegisterStore'])->name('seller.store');
    });
/*---------END SELLER ROUTES----------- */


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
