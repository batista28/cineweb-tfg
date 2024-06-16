<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ListaItem;


class PeliculaController extends Controller
{
    /**
     * Muestra una lista de todas las películas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $orderField = $request->input('orderField', 'puntuacion_media_asc');
        $order = $request->input('order', 'asc');
        $search = $request->input('search');

        switch ($orderField) {
            case 'titulo_desc':
                $orderField = 'titulo';
                $order = 'desc';
                break;
            case 'titulo_asc':
                $orderField = 'titulo';
                $order = 'asc';
                break;
            case 'puntuacion_media_desc':
                $orderField = 'puntuacion_media';
                $order = 'desc';
                break;
            case 'puntuacion_media_asc':
                $orderField = 'puntuacion_media';
                $order = 'asc';
                break;
            case 'ano_lanzamiento_desc':
                $orderField = 'ano_lanzamiento';
                $order = 'desc';
                break;
            case 'ano_lanzamiento_asc':
                $orderField = 'ano_lanzamiento';
                $order = 'asc';
                break;
        }

        $query = Pelicula::orderBy($orderField, $order);

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('titulo', 'LIKE', "%{$search}%")
                    ->orWhere('ano_lanzamiento', 'LIKE', "%{$search}%");
            });
        }

        $peliculas = $query->paginate($perPage)->withQueryString();

        return view('peliculas.index')->with([
            'peliculas' => $peliculas,
            'perPage' => $perPage,
            'order' => $order,
            'orderField' => $request->input('orderField'),
            'search' => $search // pasamos el valor de búsqueda a la vista
        ]);
    }

    /**
     * Muestra el formulario para crear una nueva película.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peliculas.create');
    }

    /**
     * Almacena una nueva película en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            // Otras reglas de validación...
        ]);

        Pelicula::create($request->all());

        return redirect()->route('peliculas.index')
            ->with('success', 'Película creada exitosamente.');
    }

    /**
     * Muestra el formulario para editar la película especificada.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */

    public function edit(Pelicula $pelicula)
    {
        // Verificar si el usuario es un administrador
        if (!auth()->user()->is_admin) {
            abort(403, 'No tienes permisos para editar esta película.');
        }

        return view('peliculas.edit', compact('pelicula'));
    }



    /**
     * Actualiza la película especificada en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            abort(403, 'Debes iniciar sesión para actualizar esta película.');
        }

        // Verificar si el usuario es un administrador
        if (!Auth::user()->is_admin) {
            abort(403, 'No tienes permisos para actualizar esta película.');
        }

        $request->validate([
            'titulo' => 'required|max:255',
            'sinopsis' => 'required|string',
            'genero' => 'required|string|max:255',
            'ano_lanzamiento' => 'required|integer',
            'director' => 'required|string|max:255',
            'puntuacion_media' => 'required|numeric|min:0|max:10',
        ]);

        $pelicula->update($request->all());

        return redirect()->route('peliculas.index')
            ->with('success', 'Película actualizada exitosamente.');
    }


    /**
     * Elimina la película especificada de la base de datos.
     *
     * @param  \App\Models\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        // Verificar si el usuario es un administrador
        if (auth()->user()->is_admin) {
            // Eliminar la serie
            $serie->delete();
            return redirect()->route('series.index')->with('success', '¡La serie ha sido eliminada exitosamente!');
        } else {
            return redirect()->route('series.index')->with('error', 'No tienes permiso para eliminar series.');
        }
    }



    public function politicaprivacidad()
    {
        return view('politicaprivacidad');
    }

    public function mostrarFormularioCrear()
    {
        return view('crear_pelicula');
    }

    public function show($id)
    {
        // Obtener la película seleccionada
        $pelicula = Pelicula::findOrFail($id);

        // Verificar si el usuario está autenticado
        $user = Auth::user();

        // Verificar si la película está en la lista de pendientes del usuario
        $enListaPendientes = false;
        if ($user) {
            $listaPendientes = ListaItem::whereHas('lista', function ($query) use ($user) {
                $query->where('ID_usuario', $user->id)
                    ->where('nombre_lista', 'peliculas_pendientes');
            })->where('pelicula_id', $pelicula->id)->exists();

            if ($listaPendientes) {
                $enListaPendientes = true;
            }
        }

        // Verificar si la película está en la lista de vistas del usuario
        $enListaVistas = false;
        if ($user) {
            $listaVistas = ListaItem::whereHas('lista', function ($query) use ($user) {
                $query->where('ID_usuario', $user->id)
                    ->where('nombre_lista', 'peliculas_vistas');
            })->where('pelicula_id', $pelicula->id)->exists();

            if ($listaVistas) {
                $enListaVistas = true;
            }
        }

        // Obtener películas relacionadas por género (excluyendo la película actual)
        $peliculasRelacionadasPorGenero = Pelicula::where('genero', $pelicula->genero)
            ->where('id', '!=', $id) // Excluir la película seleccionada
            ->take(1) // Limitar a 1 película relacionada
            ->get();

        // Obtener películas relacionadas por director (excluyendo la película actual)
        $peliculasRelacionadasPorDirector = Pelicula::where('director', $pelicula->director)
            ->where('id', '!=', $id) // Excluir la película seleccionada
            ->take(1) // Limitar a 1 película relacionada
            ->get();

        return view('peliculas.show', compact('pelicula', 'enListaPendientes', 'enListaVistas', 'peliculasRelacionadasPorGenero', 'peliculasRelacionadasPorDirector'));
    }

    public function crear(Request $request)
    {
        // Verificar si el usuario es un administrador
        if (auth()->user()->role === 'admin') {
            // Lógica para crear una nueva película
            $pelicula = new Pelicula();
            $pelicula->titulo = $request->input('titulo');
            // Agregar otros campos
            $pelicula->save();
            // Redireccionar o devolver alguna respuesta apropiada
        } else {
            // Manejar caso en que el usuario no sea un administrador
            abort(403, 'No tienes permisos para crear una nueva película.');
        }
    }

    public function calificar(Request $request, Pelicula $pelicula)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:1|max:10',
        ]);

        // Obtener la calificación del usuario
        $calificacion = $request->input('calificacion');

        // Calcular la nueva puntuación media
        $nuevaCantidadVotos = $pelicula->cantidad_votos + 1;
        $nuevaPuntuacionMedia = (($pelicula->puntuacion_media * $pelicula->cantidad_votos) + $calificacion) / $nuevaCantidadVotos;

        // Actualizar los campos de la película
        $pelicula->cantidad_votos = $nuevaCantidadVotos;
        $pelicula->puntuacion_media = $nuevaPuntuacionMedia;
        $pelicula->save();

        return redirect()->route('peliculas.show', $pelicula->id)
            ->with('success', 'Calificación registrada exitosamente.');
    }
}
