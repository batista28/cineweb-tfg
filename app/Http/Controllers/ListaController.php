<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
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
                    $query->where('ID_usuario', $user->id)->where('nombre_lista', 'like', 'series_%');
                })->where('estado', $estado)->with('serie')->get();
            }

            // Consulta para elementos de películas
            elseif (strpos($tipo, 'peliculas_') === 0) {
                $items = ListaItem::whereHas('lista', function ($query) use ($user, $tipo) {
                    $query->where('ID_usuario', $user->id)->where('nombre_lista', 'like', 'peliculas_%');
                })->where('estado', $estado)->with('pelicula')->get();
            }
        }

        return view('listas.index', compact('items', 'tipo', 'estado', 'nombreUsuario'));
    }



    public function agregarVista($tipo, $id, Request $request)
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        Log::info('Usuario autenticado: ', ['user_id' => $user->id]);

        if ($tipo == 'series_pendientes') {
            // Buscar el item en la tabla ListaItem que corresponde a la serie
            $item = ListaItem::whereHas('lista', function ($query) use ($user) {
                $query->where('ID_usuario', $user->id)
                    ->where('nombre_lista', 'series_pendientes');
            })->where('serie_id', $id)->first();

            Log::info('Serie pendiente encontrada: ', ['item' => $item]);

            // Cambiar el estado a 'vista' y guardar
            if ($item) {
                $item->estado = 'vista';
                $item->save();
                Log::info('Estado de la serie cambiado a vista: ', ['item' => $item]);
                return redirect()->route('listas.index', ['tipo' => 'series_vistas']);
            }
        } elseif ($tipo == 'peliculas_pendientes') {
            // Buscar el item en la tabla ListaItem que corresponde a la película
            $item = ListaItem::whereHas('lista', function ($query) use ($user) {
                $query->where('ID_usuario', $user->id)
                    ->where('nombre_lista', 'peliculas_pendientes');
            })->where('pelicula_id', $id)->first();

            Log::info('Película pendiente encontrada: ', ['item' => $item]);

            // Cambiar el estado a 'vista' y guardar
            if ($item) {
                $item->estado = 'vista';
                $item->save();
                Log::info('Estado de la película cambiado a vista: ', ['item' => $item]);
                return redirect()->route('listas.index', ['tipo' => 'peliculas_vistas']);
            }
        }
        if ($request->estado === 'vista') {
            session()->flash('showMovieAlert', true);
        }
        Log::info('Redirigiendo a la lista original debido a que no se encontró el ítem o no se pudo actualizar.');
        return redirect()->route('listas.index', ['tipo' => $tipo]);
    }

    public function addSerie(Request $request)
    {
        // Obtener el ID de la serie y el nombre de la lista desde la solicitud
        $serieId = $request->input('serieId');
        $nombreLista = $request->input('nombre_lista');
    
        // Establecer el estado según el tipo de lista
        $estado = ($nombreLista === 'series_vistas') ? 'vista' : 'pendiente';
    
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Buscar la lista del usuario
        $lista = Lista::where('ID_usuario', $user->id)->where('nombre_lista', $nombreLista)->first();
    
        if (!$lista) {
            return back()->with('error', 'La lista no existe.');
        }
    
        // Verificar si la serie ya está en la lista de pendientes o vistas
        $serieEnLista = ListaItem::where('ID_lista', $lista->ID_lista)
                                 ->where('serie_id', $serieId)
                                 ->exists();
    
        if ($serieEnLista) {
            return back()->with('error', 'La serie ya está en la lista.');
        }
    
        // Crear un nuevo item de lista para la serie
        $listaItem = new ListaItem();
        $listaItem->ID_lista = $lista->ID_lista;
        $listaItem->serie_id = $serieId;
        $listaItem->estado = $estado;
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

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Buscar la lista del usuario
        $lista = Lista::where('ID_usuario', $user->id)->where('nombre_lista', $nombreLista)->first();

        if (!$lista) {
            return back()->with('error', 'La lista no existe.');
        }

        // Verificar si la película ya está en la lista de pendientes o vistas
        $peliculaEnLista = ListaItem::where('ID_lista', $lista->ID_lista)
            ->where('pelicula_id', $peliculaId)
            ->exists();

        if ($peliculaEnLista) {
            return back()->with('error', 'La película ya está en la lista.');
        }

        // Crear un nuevo item de lista para la película
        $listaItem = new ListaItem();
        $listaItem->ID_lista = $lista->ID_lista;
        $listaItem->pelicula_id = $peliculaId;
        $listaItem->estado = $estado;
        $listaItem->save();

        return back()->with('success', 'La película se ha añadido a la lista correctamente.');
    }


}


