<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogosController extends Controller
{
    /**
     * Display the catalogos index page.
     */
    public function index()
    {
        return view('catalogos');
    }
}
