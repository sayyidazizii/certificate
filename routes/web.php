<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DojoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\WinnerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CoreBranchController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ParticipantController;

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
    Route::get('/', [DojoController::class, 'index'])->name('index');  // Menampilkan list Dojo
    Route::get('/create', [DojoController::class, 'create'])->name('create');  // Menampilkan form create Dojo
    Route::post('/', [DojoController::class, 'store'])->name('store');  // Proses create Dojo
    Route::get('{dojo}/edit', [DojoController::class, 'edit'])->name('edit');  // Menampilkan form edit Dojo
    Route::put('{dojo}', [DojoController::class, 'update'])->name('update');  // Proses update Dojo
    Route::delete('{dojo}', [DojoController::class, 'destroy'])->name('destroy');  // Proses delete Dojo

    // Add the routes for import functionality
    Route::get('/import', [DojoController::class, 'importForm'])->name('importForm');  // Menampilkan form import Dojo
    Route::post('/import', [DojoController::class, 'import'])->name('import');  // Proses import Dojo
});


Route::prefix('winner')->name('winner.')->group(function () {
    Route::get('/', [WinnerController::class, 'index'])->name('index');  // Menampilkan list unit
    Route::get('/create', [WinnerController::class, 'create'])->name('create');  // Menampilkan form create unit
    Route::post('/', [WinnerController::class, 'store'])->name('store');  // Proses create unit
    Route::get('{winner}/edit', [WinnerController::class, 'edit'])->name('edit');  // Menampilkan form edit unit
    Route::put('{winner}', [WinnerController::class, 'update'])->name('update');  // Proses update unit
    Route::delete('{winner}', [WinnerController::class, 'destroy'])->name('destroy');  // Proses delete
    Route::get('import', [WinnerController::class, 'importForm'])->name('importForm');  // Import winners form
    Route::post('import', [WinnerController::class, 'import'])->name('import');  // Process import winners
});

Route::prefix('participant')->name('participant.')->group(function () {
    Route::get('/', [ParticipantController::class, 'index'])->name('index');  // Menampilkan list participants
    Route::get('/create', [ParticipantController::class, 'create'])->name('create');  // Menampilkan form create participant
    Route::post('/', [ParticipantController::class, 'store'])->name('store');  // Proses create participant
    Route::get('{participant}/edit', [ParticipantController::class, 'edit'])->name('edit');  // Menampilkan form edit participant
    Route::put('{participant}', [ParticipantController::class, 'update'])->name('update');  // Proses update participant
    Route::delete('{participant}', [ParticipantController::class, 'destroy'])->name('destroy');  // Proses delete participant

    // Routes for import functionality
    Route::get('/import', [ParticipantController::class, 'importForm'])->name('importForm');  // Show import form
    Route::post('/import', [ParticipantController::class, 'import'])->name('import');  // Handle import
});

Route::prefix('certificate')->name('certificate.')->group(function () {
    Route::get('/', [CertificateController::class, 'index'])->name('index');  // Display list of certificates
    Route::post('/', [CertificateController::class, 'store'])->name('store');  // Create a new certificate
    Route::delete('{certificate}', [CertificateController::class, 'destroy'])->name('destroy');  // Delete a certificate by ID
    // Route for printing the certificate
    Route::get('print/{certificate}', [CertificateController::class, 'print'])->name('print');
});

require __DIR__.'/auth.php';
