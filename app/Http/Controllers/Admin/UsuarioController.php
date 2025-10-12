<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rfc' => 'nullable|string|max:14|min:10',
            'curp' => 'nullable|string|max:19|min:10',
            'sexo' => 'nullable|in:femenino,masculino',
            'theme' => 'nullable|in:dark,light',
            'puesto' => 'nullable|in:Director,Subdirector,Coordinador,Jefe de departamento,Analista Especializado,Analista',
            'nivel' => 'nullable|integer|min:1|max:7',
            'estatus' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        $userData = $request->except(['password_confirmation', 'photo']);
        $userData['password'] = Hash::make($request->password);
        $userData['nivel'] = $userData['nivel'] ?? 7;
        $userData['estatus'] = $userData['estatus'] ?? true;
        $userData['theme'] = $userData['theme'] ?? 'light';

        if ($request->hasFile('photo')) {
            $filename = 'profile_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('images/profiles', $filename, 'public');
            $userData['profile_photo_path'] = 'images/profiles/' . $filename;
        }

        User::create($userData);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
            'rfc' => 'nullable|string|max:14|min:10',
            'curp' => 'nullable|string|max:19|min:10',
            'sexo' => 'nullable|in:femenino,masculino',
            'theme' => 'nullable|in:dark,light',
            'puesto' => 'nullable|in:Director,Subdirector,Coordinador,Jefe de departamento,Analista Especializado,Analista',
            'nivel' => 'nullable|integer|min:1|max:7',
            'estatus' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        $userData = $request->except(['password_confirmation', 'photo']);

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        } else {
            unset($userData['password']);
        }

        if ($request->hasFile('photo')) {
            // Eliminar foto anterior si existe
            if ($usuario->profile_photo_path && file_exists(public_path($usuario->profile_photo_path))) {
                unlink(public_path($usuario->profile_photo_path));
            }

            $filename = 'profile_' . $usuario->id . '_' . time() . '.' . $request->photo->getClientOriginalExtension();
            $request->photo->storeAs('images/profiles', $filename, 'public');
            $userData['profile_photo_path'] = 'images/profiles/' . $filename;
        }

        $usuario->update($userData);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        // Eliminar foto si existe
        if ($usuario->profile_photo_path && file_exists(public_path($usuario->profile_photo_path))) {
            unlink(public_path($usuario->profile_photo_path));
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}