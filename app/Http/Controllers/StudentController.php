<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Solo mostrar estudiantes activos
        $query->where('estatus', 'activo');

        // Filtro por matrícula
        if ($request->filled('matricula')) {
            $query->where('matricula', 'like', '%' . $request->matricula . '%');
        }

        // Filtro por nombre completo (busca en nombres, apa, ama)
        if ($request->filled('nombre')) {
            $query->where(function($q) use ($request) {
                $q->where('nombres', 'like', '%' . $request->nombre . '%')
                  ->orWhere('apa', 'like', '%' . $request->nombre . '%')
                  ->orWhere('ama', 'like', '%' . $request->nombre . '%');
            });
        }

        // Filtro por grado
        if ($request->filled('grado')) {
            $query->where('grado', $request->grado);
        }

        // Filtro por grupo
        if ($request->filled('grupo')) {
            $query->where('grupo', $request->grupo);
        }

        // Filtro por email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $students = $query->orderBy('grado', 'asc')
            ->orderBy('grupo', 'asc')
            ->orderBy('apa', 'asc')
            ->paginate(15)
            ->withQueryString();

        // Si es una petición AJAX, retornar solo la tabla
        if ($request->ajax()) {
            return view('admin.students.partials.table', compact('students'));
        }

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Limpiar datos antiguos de la sesión para evitar que los campos se llenen con valores previos
        session()->forget('_old_input');
        
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricula' => 'nullable|string|max:20|unique:students,matricula',
            'grado' => 'nullable|integer|min:1|max:3',
            'grupo' => 'required|in:A,B,C,D,E,F,G,H,I,J,K,L',
            'Fnom' => 'nullable|string|max:255',
            'nombres' => 'nullable|string|max:255',
            'apa' => 'nullable|string|max:255',
            'ama' => 'nullable|string|max:255',
            'fnac' => 'nullable|date',
            'curp' => 'nullable|string|size:18|unique:students,curp',
            'sexo' => 'required|in:F,M',
            'email' => 'nullable|email|max:100|unique:students,email',
            'telefono' => 'nullable|string|max:15',
            'estatus' => 'nullable|in:activo,inactivo,egresado,baja',
            'observaciones' => 'nullable|string',
        ]);

        // Establecer valores por defecto si no se proporcionan
        $validated['estatus'] = $validated['estatus'] ?? 'activo';

        Student::create($validated);

        return redirect()->route('estudiante.index')
            ->with('success', 'Estudiante creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $estudiante)
    {
        return view('admin.students.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $estudiante)
    {
        return view('admin.students.edit', compact('estudiante'));
    }

    /**
     * Search students for AJAX requests
     */
    public function search(Request $request)
    {
        $query = Student::query();

        // Solo mostrar estudiantes activos
        $query->where('estatus', 'activo');

        // Filtro por nombre completo (busca en nombres, apa, ama)
        if ($request->filled('nombre')) {
            $query->where(function($q) use ($request) {
                $q->where('nombres', 'like', '%' . $request->nombre . '%')
                  ->orWhere('apa', 'like', '%' . $request->nombre . '%')
                  ->orWhere('ama', 'like', '%' . $request->nombre . '%');
            });
        }

        $students = $query->orderBy('apa', 'asc')
            ->orderBy('ama', 'asc')
            ->orderBy('nombres', 'asc')
            ->get();

        return view('admin.students.partials.search-table', compact('students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $estudiante)
    {
        $validated = $request->validate([
            'matricula' => 'nullable|string|max:20|unique:students,matricula,' . $estudiante->id,
            'grado' => 'nullable|integer|min:1|max:3',
            'grupo' => 'required|in:A,B,C,D,E,F,G,H,I,J,K,L',
            'Fnom' => 'nullable|string|max:255',
            'nombres' => 'nullable|string|max:255',
            'apa' => 'nullable|string|max:255',
            'ama' => 'nullable|string|max:255',
            'fnac' => 'nullable|date',
            'curp' => 'nullable|string|size:18|unique:students,curp,' . $estudiante->id,
            'sexo' => 'required|in:F,M',
            'email' => 'nullable|email|max:100|unique:students,email,' . $estudiante->id,
            'telefono' => 'nullable|string|max:15',
            'estatus' => 'nullable|in:activo,inactivo,egresado,baja',
            'observaciones' => 'nullable|string',
        ]);

        $estudiante->update($validated);

        return redirect()->route('estudiante.index')
            ->with('success', 'Estudiante actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $estudiante)
    {
        try {
            $estudiante->delete();
            return redirect()->route('estudiante.index')
                ->with('success', 'Estudiante eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index')
                ->with('error', 'No se pudo eliminar el estudiante.');
        }
    }

    /**
     * Toggle the sexo field of a student
     */
    public function toggleSexo(Student $estudiante)
    {
        try {
            $estudiante->sexo = $estudiante->sexo === 'F' ? 'M' : 'F';
            $estudiante->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Sexo actualizado exitosamente',
                'sexo' => $estudiante->sexo,
                'sexo_text' => $estudiante->sexo === 'F' ? 'Femenino' : 'Masculino'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el sexo'
            ], 500);
        }
    }
}
