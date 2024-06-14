<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lista;
use App\Models\ListaItem;
use App\Models\Serie;
use App\Models\Pelicula;
use Auth;

class ListaController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los parámetros tipo y estado de la URL
        $tipo = $request->query('tipo', 'series_pendientes');
        $estado = $request->query('estado', '');

        $items = collect();
        $nombreUsuario = '';

        // Definir los tipos que implican elementos vistos
        $tiposVistos = ['series_vistas', 'peliculas_vistas'];

        // Verificar si el tipo es de elementos vistos
        if (in_array($tipo, $tiposVistos)) {
            $estado = 'vista'; // Establecer el estado como 'vista' para tipos de elementos vistos
        } else {
            // Si el estado no se estableció o no es válido para el tipo, establecerlo como 'pendiente'
            $estado = 'pendiente';
        }

        $user = $request->user(); // Obtener el usuario autenticado de la solicitud

        if ($user) {
            $nombreUsuario = $user->name; // Obtener el nombre de usuario del usuario autenticado
        }

        // Verificar si se solicitaron elementos de series o películas pendientes o vistas
        if (
            in_array($tipo, ['series_pendientes', 'series_vistas', 'peliculas_pendientes', 'peliculas_vistas']) &&
            in_array($estado, ['pendiente', 'vista'])
        ) {
            // Consulta para elementos de series
            if (strpos($tipo, 'series_') === 0) {
                $items = ListaItem::whereHas('lista', function ($query) use ($user, $tipo) {
                    $query->where('ID_usuario', $user->id)->where('nombre_lista', $tipo);
                })->where('estado', $estado)->with('serie')->get();
            }

            // Consulta para elementos de películas
            elseif (strpos($tipo, 'peliculas_') === 0) {
                $items = ListaItem::whereHas('lista', function ($query) use ($user, $tipo) {
                    $query->where('ID_usuario', $user->id)->where('nombre_lista', $tipo);
                })->where('estado', $estado)->with('pelicula')->get();
            }
        }

        return view('listas.index', compact('items', 'tipo', 'estado', 'nombreUsuario'));
    }

    public function agregarVista($tipo, $id)
    {
        if ($tipo == 'series_pendientes') {
            $item = Serie::findOrFail($id);
            $item->estado = 'vista';
            $item->save();
            return redirect()->route('listas.index', ['tipo' => 'series_vistas']);
        } elseif ($tipo == 'peliculas_pendientes') {
            $item = Pelicula::findOrFail($id);
            $item->estado = 'vista';
            $item->save();
            return redirect()->route('listas.index', ['tipo' => 'peliculas_vistas']);
        }

        return redirect()->route('listas.index', ['tipo' => $tipo]);
    }

    public function addSerie(Request $request)
    {
        // Obtener el ID de la serie y el nombre de la lista desde la solicitud
        $serieId = $request->input('serieId');
        $nombreLista = $request->input('nombre_lista');

        // Establecer el estado según el tipo de lista
        $estado = ($nombreLista === 'series_vistas') ? 'vista' : 'pendiente';

        // Verificar si la serie ya está en la lista
        $user = Auth::user();
        $lista = Lista::where('ID_usuario', $user->id)->where('nombre_lista', $nombreLista)->first();
        if (!$lista) {
            return back()->with('error', 'La lista no existe.');
        }

        // Verificar si la serie ya está en la lista de pendientes
        $serieEnLista = ListaItem::where('ID_lista', $lista->id)->where('serie_id', $serieId)->exists();
        if ($serieEnLista) {
            return back()->with('error', 'La serie ya está en la lista.');
        }

        // Crear un nuevo item de lista para la serie
        $listaItem = new ListaItem();
        $listaItem->ID_lista = $lista->ID_lista;
        $listaItem->serie_id = $serieId;
        $listaItem->estado = $estado; // Establecer el estado según el tipo de lista
        $listaItem->save();

        return back()->with('success', 'La serie se ha añadido a la lista correctamente.');
    }



    public function addPelicula(Request $request)
    {
        // Obtener el ID de la película y el nombre de la lista desde la solicitud
        $peliculaId = $request->input('peliculaId');
        $nombreLista = $request->input('nombre_lista');

        // Establecer el estado según el tipo de lista
        $estado = ($nombreLista === 'peliculas_vistas') ? 'vista' : 'pendiente';

        // Verificar si la película ya está en la lista
        $user = Auth::user();
        $lista = Lista::where('ID_usuario', $user->id)->where('nombre_lista', $nombreLista)->first();
        if (!$lista) {
            return back()->with('error', 'La lista no existe.');
        }

        // Verificar si la película ya está en la lista de pendientes o vistas
        $peliculaEnLista = ListaItem::where('ID_lista', $lista->id)->where('pelicula_id', $peliculaId)->exists();
        if ($peliculaEnLista) {
            return back()->with('error', 'La película ya está en la lista.');
        }

        // Crear un nuevo item de lista para la película
        $listaItem = new ListaItem();
        $listaItem->ID_lista = $lista->ID_lista;
        $listaItem->pelicula_id = $peliculaId;
        $listaItem->estado = $estado; // Establecer el estado según el tipo de lista
        $listaItem->save();

        return back()->with('success', 'La película se ha añadido a la lista correctamente.');
    }

}


