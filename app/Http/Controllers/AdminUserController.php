<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        // Aquí obtenemos todos los usuarios
        $users = User::all();

        // Retornamos la vista 'admin.users.index' y le pasamos la variable $users
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Retornamos la vista 'admin.users.create' para crear un nuevo usuario
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        // Validamos los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'sometimes|boolean',
        ]);

        // Creamos un nuevo usuario en la base de datos
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $request->has('is_admin') ? $request->is_admin : false,
        ]);

        // Redirigimos de vuelta al listado de usuarios
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        // Mostramos los detalles de un usuario específico
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // Retornamos la vista 'admin.users.edit' para editar un usuario
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validamos los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'sometimes|boolean',
        ]);

        // Actualizamos los datos del usuario en la base de datos
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
            'is_admin' => $request->has('is_admin') ? $request->is_admin : $user->is_admin,
        ]);

        // Redirigimos de vuelta al listado de usuarios
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Eliminamos un usuario de la base de datos
        $user->delete();

        // Redirigimos de vuelta al listado de usuarios
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
