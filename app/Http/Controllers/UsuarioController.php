<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsuarioController extends Controller
{
    /**
     * Muestra un listado de los usuarios.
     */
    public function index()
    {
        $usuarios = \App\Models\Usuario::all();
        return Inertia::render('Usuarios/Index', [
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo usuario.
     */
    public function create()
    {
        return Inertia::render('Usuarios/Create');
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:usuarios',
            'email' => 'required|email|max:255|unique:usuarios',
            'contraseña' => 'required|string|min:6',
        ]);

        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        $usuario->contraseña = Hash::make($request->contraseña);
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un usuario existente.
     */
    public function edit(Usuario $usuario)
    {
        return Inertia::render('Usuarios/Edit', [
            'usuario' => $usuario
        ]);
    }

    /**
     * Actualiza la información de un usuario en la base de datos.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:usuarios,usuario,' . $usuario->id,
            'email' => 'required|email|max:255|unique:usuarios,email,' . $usuario->id,
            'contraseña' => 'nullable|string|min:6',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->usuario = $request->usuario;
        $usuario->email = $request->email;
        
        if ($request->filled('contraseña')) {
            $usuario->contraseña = Hash::make($request->contraseña);
        }
        
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario de la base de datos.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
} 