@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: auto;">
    <h1 style="color: white;margin-bottom: 20px;">Usuarios</h1>
    <a href="{{ route('admin.users.create') }}"
        style="color: white;background-color: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; margin-bottom: 20px; display: inline-block;">Crear
        un
        Usuario</a>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="color: white; background-color: #343a40; border-bottom: 1px solid #ddd; padding: 8px;">Nombre
                </th>
                <th style="color: white; background-color: #343a40; border-bottom: 1px solid #ddd; padding: 8px;">Email
                </th>
                <th style="color: white; background-color: #343a40; border-bottom: 1px solid #ddd; padding: 8px;">
                    Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="color: white;background-color: #343a40; padding: 8px;">{{ $user->name }}</td>
                    <td style="color: white;background-color: #343a40;padding: 8px;">{{ $user->email }}</td>
                    <td style="color: white;background-color: #343a40;padding: 8px;">
                        <a href="{{ route('admin.users.show', $user) }}"
                            style="background-color: #17a2b8; color: white; padding: 5px 10px; border: none; border-radius: 5px; text-decoration: none; margin-right: 5px;">Mostrar</a>
                        <a href="{{ route('admin.users.edit', $user) }}"
                            style="background-color: #ffc107; color: white; padding: 5px 10px; border: none; border-radius: 5px; text-decoration: none; margin-right: 5px;">Editar</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="background-color: #dc3545; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection