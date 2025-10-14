<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class CatalogosController extends Controller
{
    /**
     * Display the catalogos index page.
     */
    public function index()
    {
        return view('catalogos');
    }

    /**
     * Get materias filtered by grado and search term
     */
    public function getMaterias(Request $request)
    {
        $query = Materia::query();

        // Filtrar por grado si se proporciona
        if ($request->filled('grado')) {
            $query->where('grado', $request->grado);
        }

        // Buscar por nombre de materia si se proporciona
        if ($request->filled('nombre') || $request->filled('materia')) {
            $searchTerm = $request->filled('nombre') ? $request->nombre : $request->materia;
            $query->where('materia', 'like', '%' . $searchTerm . '%');
        }

        $materias = $query->orderBy('grado', 'asc')
            ->orderBy('materia', 'asc')
            ->get();

        // Si es una petición AJAX para modal, retornar vista
        if ($request->ajax() && $request->has('modal')) {
            return view('admin.materias.partials.search-table', compact('materias'));
        }

        return response()->json([
            'materias' => $materias
        ]);
    }
}
