<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BitacoraController;

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

Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Components page
    Route::get('/components', function () {
        return view('pages/components');
    })->name('components');

    // QR Code page
    Route::get('/qr', [QrCodeController::class, 'index'])->name('qr');
    Route::post('/qr/generate', [QrCodeController::class, 'generate'])->name('qr.generate');

    // Admin - Usuarios CRUD
    Route::resource('usuarios', UsuarioController::class)->names('usuarios');

    // Admin - Students CRUD
    Route::resource('students', StudentController::class)->names('students');

    // Admin - Bitacoras CRUD
    Route::resource('bitacoras', BitacoraController::class)->names('bitacoras');

    // 404 fallback
    Route::fallback(function() {
        return view('pages/utility/404');
    });    
});
