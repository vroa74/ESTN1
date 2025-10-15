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
    Route::get('estudiante/search', [StudentController::class, 'search'])->name('estudiante.search');
    // Admin - Bitacoras CRUD
    Route::resource('bitacoras', BitacoraController::class)->names('bitacoras');
    // Admin - Reportes Alumnos CRUD
    Route::resource('reportes', ReporteAlumnoController::class)->names('reportes');
    Route::patch('reportes/{reporte}/firmar-prefecto', [ReporteAlumnoController::class, 'firmarPrefecto'])->name('reportes.firmar-prefecto');
    Route::patch('reportes/{reporte}/firmar-trabajador-social', [ReporteAlumnoController::class, 'firmarTrabajadorSocial'])->name('reportes.firmar-trabajador-social');
    Route::patch('reportes/{reporte}/cambiar-estado', [ReporteAlumnoController::class, 'cambiarEstado'])->name('reportes.cambiar-estado');
    Route::get('reportes/{reporte}/pdf', [ReporteAlumnoController::class, 'pdf'])->name('reportes.pdf');
    // Admin - Materias
    Route::get('materias', [App\Http\Controllers\CatalogosController::class, 'index'])->name('materias.index');
    Route::get('materias/search', [App\Http\Controllers\CatalogosController::class, 'getMaterias'])->name('materias.search');
    
    // Debug route para verificar docentes
    Route::get('debug/docentes', function() {
        $docentes = App\Models\User::where('puesto', 'DOCENTE')->get(['id', 'name', 'email', 'puesto', 'estatus']);
        $allUsers = App\Models\User::all(['id', 'name', 'email', 'puesto', 'estatus']);
        
        $html = '<h1>Debug de Usuarios</h1>';
        $html .= '<h2>Usuarios con puesto DOCENTE (' . $docentes->count() . '):</h2>';
        foreach($docentes as $user) {
            $html .= '<p>ID: ' . $user->id . ' | Nombre: ' . $user->name . ' | Puesto: [' . $user->puesto . '] | Email: ' . $user->email . '</p>';
        }
        
        $html .= '<h2>Todos los usuarios (' . $allUsers->count() . '):</h2>';
        foreach($allUsers as $user) {
            $html .= '<p>ID: ' . $user->id . ' | Nombre: ' . $user->name . ' | Puesto: [' . $user->puesto . '] | Email: ' . $user->email . '</p>';
        }
        
        return $html;
    });

    // Debug route para verificar reportes (sin auth)
    Route::get('debug/reportes-public', function() {
        $reporte = App\Models\ReporteAlumno::with(['student', 'profesor', 'prefecto', 'trabajadorSocial'])->latest()->first();
        
        if (!$reporte) {
            return 'No hay reportes en la base de datos';
        }

        $html = '<h1>Debug del Último Reporte</h1>';
        $html .= '<h2>Datos del Reporte:</h2>';
        $html .= '<p>ID: ' . $reporte->id . '</p>';
        $html .= '<p>Fecha: ' . ($reporte->fecha_reporte ? $reporte->fecha_reporte->format('Y-m-d') : 'NULL') . '</p>';
        $html .= '<p>Materia: ' . $reporte->materia . '</p>';
        $html .= '<p>Estado: ' . $reporte->estado . '</p>';
        
        $html .= '<h2>Relaciones:</h2>';
        $html .= '<p>Estudiante: ' . ($reporte->student ? $reporte->student->full_name : 'NULL') . '</p>';
        $html .= '<p>Profesor ID: ' . $reporte->profesor_id . ' - Nombre: ' . ($reporte->profesor ? $reporte->profesor->name : 'NULL') . '</p>';
        $html .= '<p>Prefecto ID: ' . $reporte->prefecto_id . ' - Nombre: ' . ($reporte->prefecto ? $reporte->prefecto->name : 'NULL') . '</p>';
        $html .= '<p>Trabajo Social ID: ' . $reporte->trabajo_social_id . ' - Nombre: ' . ($reporte->trabajadorSocial ? $reporte->trabajadorSocial->name : 'NULL') . '</p>';

        return $html;
    });
    // 404 fallback
    Route::fallback(function() {
        return view('pages/utility/404');
    });    
});
