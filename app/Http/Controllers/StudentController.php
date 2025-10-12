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
    public function index()
    {
        $students = Student::orderBy('grado', 'asc')
            ->orderBy('grupo', 'asc')
            ->orderBy('apa', 'asc')
            ->paginate(15);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'matricula' => 'nullable|string|max:20|unique:students,matricula',
            'grado' => 'nullable|integer|min:1|max:9',
            'grupo' => 'required|in:A,B,C,D,E,F,G,H,I,J,K,L',
            'Fnom' => 'nullable|string|max:255',
            'nombres' => 'nullable|string|max:255',
            'apa' => 'nullable|string|max:255',
            'ama' => 'nullable|string|max:255',
            'fnac' => 'nullable|date',
            'curp' => 'nullable|string|size:18|unique:students,curp',
            'sexo' => 'required|in:F,M',
            'sex' => 'nullable|boolean',
            'email' => 'nullable|email|max:100|unique:students,email',
            'telefono' => 'nullable|string|max:15',
            'estatus' => 'nullable|in:activo,inactivo,egresado,baja',
            'observaciones' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        // Establecer valores por defecto si no se proporcionan
        $validated['estatus'] = $validated['estatus'] ?? 'activo';
        $validated['status'] = $validated['status'] ?? true;
        $validated['sex'] = $validated['sex'] ?? true;

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Estudiante creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'matricula' => 'nullable|string|max:20|unique:students,matricula,' . $student->id,
            'grado' => 'nullable|integer|min:1|max:9',
            'grupo' => 'required|in:A,B,C,D,E,F,G,H,I,J,K,L',
            'Fnom' => 'nullable|string|max:255',
            'nombres' => 'nullable|string|max:255',
            'apa' => 'nullable|string|max:255',
            'ama' => 'nullable|string|max:255',
            'fnac' => 'nullable|date',
            'curp' => 'nullable|string|size:18|unique:students,curp,' . $student->id,
            'sexo' => 'required|in:F,M',
            'sex' => 'nullable|boolean',
            'email' => 'nullable|email|max:100|unique:students,email,' . $student->id,
            'telefono' => 'nullable|string|max:15',
            'estatus' => 'nullable|in:activo,inactivo,egresado,baja',
            'observaciones' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Estudiante actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
            return redirect()->route('students.index')
                ->with('success', 'Estudiante eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')
                ->with('error', 'No se pudo eliminar el estudiante.');
        }
    }
}
