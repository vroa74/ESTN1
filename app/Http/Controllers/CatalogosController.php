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
        if ($request->filled('materia')) {
            $query->where('materia', 'like', '%' . $request->materia . '%');
        }

        $materias = $query->orderBy('grado', 'asc')
            ->orderBy('materia', 'asc')
            ->get();

        return response()->json([
            'materias' => $materias
        ]);
    }
}
