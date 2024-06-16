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
    <button onclick="window.location.href='{{ route('admin.users.index') }}'" class="btn-style">Volver a
        Usuarios</button>

</div>
@endsection