<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteAlumno;
use App\Models\Student;
use App\Models\User;

class ReporteAlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ReporteAlumno::with(['student', 'profesor', 'prefecto', 'trabajadorSocial']);

        // Filtros
        if ($request->filled('estudiante')) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('nombres', 'like', '%' . $request->estudiante . '%')
                  ->orWhere('apa', 'like', '%' . $request->estudiante . '%')
                  ->orWhere('ama', 'like', '%' . $request->estudiante . '%');
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('materia')) {
            $query->where('materia', 'like', '%' . $request->materia . '%');
        }

        if ($request->filled('fecha_desde')) {
            $query->whereDate('fecha_reporte', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->whereDate('fecha_reporte', '<=', $request->fecha_hasta);
        }

        $reportes = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.reportes.index', compact('reportes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Student::where('estatus', 'activo')
            ->orderBy('apa')
            ->orderBy('ama')
            ->orderBy('nombres')
            ->get();
        
        $profesores = User::where('puesto', 'DOCENTE')
            ->where('estatus', true)
            ->orderBy('name')
            ->get();

        $prefectos = User::where('puesto', 'PREFECTURA')
            ->where('estatus', true)
            ->orderBy('name')
            ->get();

        $trabajadores_sociales = User::where('puesto', 'TRABAJO SOCIAL')
            ->where('estatus', true)
            ->orderBy('name')
            ->get();

        return view('admin.reportes.create', compact('estudiantes', 'profesores', 'prefectos', 'trabajadores_sociales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fecha_reporte' => 'required|date',
            'materia' => 'required|string|max:100',
            'profesor_id' => 'required|exists:users,id',
            'descripcion_reporte' => 'required|string|max:2000',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        // Verificar que el profesor sea docente
        $profesor = User::find($validated['profesor_id']);
        if (!$profesor || $profesor->puesto !== 'DOCENTE') {
            return back()->withErrors(['profesor_id' => 'El usuario seleccionado no es un docente válido.']);
        }

        $validated['estado'] = 'pendiente';
        $validated['version'] = 1;

        ReporteAlumno::create($validated);

        return redirect()->route('reportes.index')
            ->with('success', 'Reporte creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReporteAlumno $reporte)
    {
        $reporte->load(['student', 'profesor', 'prefecto', 'trabajadorSocial']);
        return view('admin.reportes.show', compact('reporte'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReporteAlumno $reporte)
    {
        // Solo permitir edición si está pendiente
        if ($reporte->estado !== 'pendiente') {
            return redirect()->route('reportes.show', $reporte)
                ->with('error', 'No se puede editar un reporte que ya ha sido firmado.');
        }

        $estudiantes = Student::where('estatus', 'activo')
            ->orderBy('apa')
            ->orderBy('ama')
            ->orderBy('nombres')
            ->get();
        
        $profesores = User::where('puesto', 'DOCENTE')
            ->where('estatus', true)
            ->orderBy('name')
            ->get();

        return view('admin.reportes.edit', compact('reporte', 'estudiantes', 'profesores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReporteAlumno $reporte)
    {
        // Solo permitir edición si está pendiente
        if ($reporte->estado !== 'pendiente') {
            return redirect()->route('reportes.show', $reporte)
                ->with('error', 'No se puede editar un reporte que ya ha sido firmado.');
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'fecha_reporte' => 'required|date',
            'materia' => 'required|string|max:100',
            'profesor_id' => 'required|exists:users,id',
            'descripcion_reporte' => 'required|string|max:2000',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        // Verificar que el profesor sea docente
        $profesor = User::find($validated['profesor_id']);
        if (!$profesor || $profesor->puesto !== 'DOCENTE') {
            return back()->withErrors(['profesor_id' => 'El usuario seleccionado no es un docente válido.']);
        }

        $reporte->update($validated);

        return redirect()->route('reportes.show', $reporte)
            ->with('success', 'Reporte actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReporteAlumno $reporte)
    {
        // Solo permitir eliminación si está pendiente
        if ($reporte->estado !== 'pendiente') {
            return redirect()->route('reportes.index')
                ->with('error', 'No se puede eliminar un reporte que ya ha sido firmado.');
        }

        $reporte->delete();

        return redirect()->route('reportes.index')
            ->with('success', 'Reporte eliminado exitosamente.');
    }

    /**
     * Firmar reporte como prefecto
     */
    public function firmarPrefecto(Request $request, ReporteAlumno $reporte)
    {
        if (!$reporte->puedeFirmarPrefecto()) {
            return redirect()->route('reportes.show', $reporte)
                ->with('error', 'No se puede firmar este reporte en su estado actual.');
        }

        $reporte->update([
            'estado' => 'firmado_prefecto',
            'firma_prefecto_at' => now(),
            'prefecto_id' => auth()->id()
        ]);

        return redirect()->route('reportes.show', $reporte)
            ->with('success', 'Reporte firmado como prefecto exitosamente.');
    }

    /**
     * Firmar reporte como trabajador social
     */
    public function firmarTrabajadorSocial(Request $request, ReporteAlumno $reporte)
    {
        if (!$reporte->puedeFirmarTrabajoSocial()) {
            return redirect()->route('reportes.show', $reporte)
                ->with('error', 'No se puede firmar este reporte en su estado actual.');
        }

        $reporte->update([
            'estado' => 'completado',
            'firma_trabajo_social_at' => now(),
            'trabajo_social_id' => auth()->id()
        ]);

        return redirect()->route('reportes.show', $reporte)
            ->with('success', 'Reporte firmado como trabajador social exitosamente.');
    }

    /**
     * Generar PDF del reporte
     */
    public function pdf(ReporteAlumno $reporte)
    {
        $reporte->load(['student', 'profesor', 'prefecto', 'trabajadorSocial']);
        
        // Aquí implementarías la generación del PDF
        // Por ahora retornamos una vista que simula el PDF
        return view('admin.reportes.pdf', compact('reporte'));
    }
}
