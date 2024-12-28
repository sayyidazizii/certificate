<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CoreBranchController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Route::view('/', 'welcome');
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login'); // Redirect ke halaman login setelah logout
})->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::prefix('menus')->name('menus.')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('index');
});

Route::prefix('CoreBranch')->name('CoreBranch.')->group(function () {
    Route::get('/', [CoreBranchController::class, 'index'])->name('index');  // Menampilkan list unit
    Route::get('/create', [CoreBranchController::class, 'create'])->name('create');  // Menampilkan form create unit
    Route::post('/', [CoreBranchController::class, 'store'])->name('store');  // Proses create unit
    Route::get('{CoreBranch}/edit', [CoreBranchController::class, 'edit'])->name('edit');  // Menampilkan form edit unit
    Route::put('{CoreBranch}', [CoreBranchController::class, 'update'])->name('update');  // Proses update unit
    Route::delete('{CoreBranch}', [CoreBranchController::class, 'destroy'])->name('destroy');  // Proses delete unit
});

Route::prefix('dojo')->name('dojo.')->group(function () {
    Route::get('/', [DojoController::class, 'index'])->name('index');  // Menampilkan list unit
    Route::get('/create', [DojoController::class, 'create'])->name('create');  // Menampilkan form create unit
    Route::post('/', [DojoController::class, 'store'])->name('store');  // Proses create unit
    Route::get('{dojo}/edit', [DojoController::class, 'edit'])->name('edit');  // Menampilkan form edit unit
    Route::put('{dojo}', [DojoController::class, 'update'])->name('update');  // Proses update unit
    Route::delete('{dojo}', [DojoController::class, 'destroy'])->name('destroy');  // Proses delete unit
});

require __DIR__.'/auth.php';
