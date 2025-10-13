<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ReporteAlumnoController;

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
    Route::get('/components', function () {         return view('pages/components');      })->name('components');
    // QR Code page
    Route::get('/qr', [QrCodeController::class, 'index'])->name('qr');
    Route::post('/qr/generate', [QrCodeController::class, 'generate'])->name('qr.generate');
            // Admin - Usuarios CRUD
            Route::get('usuarios/search', [App\Http\Controllers\Admin\UsuarioController::class, 'search'])->name('usuarios.search');
            Route::resource('usuarios', UsuarioController::class)->names('usuarios');
    // Admin - Students CRUD
    Route::resource('estudiante', StudentController::class)->names('estudiante');
    Route::patch('estudiante/{estudiante}/toggle-sexo', [StudentController::class, 'toggleSexo'])->name('estudiante.toggle-sexo');
    // Admin - Bitacoras CRUD
    Route::resource('bitacoras', BitacoraController::class)->names('bitacoras');
    // Admin - Reportes Alumnos CRUD
    Route::resource('reportes', ReporteAlumnoController::class)->names('reportes');
    Route::patch('reportes/{reporte}/firmar-prefecto', [ReporteAlumnoController::class, 'firmarPrefecto'])->name('reportes.firmar-prefecto');
    Route::patch('reportes/{reporte}/firmar-trabajador-social', [ReporteAlumnoController::class, 'firmarTrabajadorSocial'])->name('reportes.firmar-trabajador-social');
    Route::get('reportes/{reporte}/pdf', [ReporteAlumnoController::class, 'pdf'])->name('reportes.pdf');
    // Admin - Materias
    Route::get('materias', [App\Http\Controllers\CatalogosController::class, 'index'])->name('materias.index');
    Route::get('materias/search', [App\Http\Controllers\CatalogosController::class, 'getMaterias'])->name('materias.search');
    // 404 fallback
    Route::fallback(function() {
        return view('pages/utility/404');
    });    
});
