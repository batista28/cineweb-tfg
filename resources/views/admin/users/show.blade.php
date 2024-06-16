@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: auto;">
    <h1 style="color: white; margin-bottom: 20px;">Detalle de Usuario</h1>
    <div style="background-color: #343a40; border-radius: 5px; color: white; margin-bottom: 20px;">
        <div style="padding: 20px;">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
        <div style="background-color: #343a40; padding: 20px;">
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    style="background-color: #dc3545; color: white; padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer;">Borrar</button>
            </form>
        </div>
    </div>
    <a href="{{ route('admin.users.index') }}"
        style="background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; display: inline-block;">Volver
        a Usuarios</a>
</div>
@endsection