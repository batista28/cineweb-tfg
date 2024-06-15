<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $orderField = $request->input('orderField', 'titulo_asc');
        $buscar = $request->input('buscar');

        $query = Serie::query();

        // Aplicar búsqueda si se especifica
        if ($buscar) {
            $query->where('titulo', 'LIKE', "%$buscar%")
                ->orWhere('sinopsis', 'LIKE', "%$buscar%");
        }

        // Aplicar ordenamiento
        if ($orderField === 'titulo_asc') {
            $query->orderBy('titulo');
        } elseif ($orderField === 'titulo_desc') {
            $query->orderByDesc('titulo');
        } elseif ($orderField === 'puntuacion_media_asc') {
            $query->orderBy('puntuacion_media');
        } elseif ($orderField === 'puntuacion_media_desc') {
            $query->orderByDesc('puntuacion_media');
        } elseif ($orderField === 'ano_lanzamiento_asc') {
            $query->orderBy('ano_lanzamiento');
        } elseif ($orderField === 'ano_lanzamiento_desc') {
            $query->orderByDesc('ano_lanzamiento');
        }

        // Obtener los resultados paginados
        $series = $query->paginate($perPage);

        return view('series.index', compact('series'));
    }

    public function create(Request $request)
    {
        dd($request);
        return view('series.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'genero' => 'required|string|max:255',
            'ano_lanzamiento' => 'required|integer|min:1900|max:9999',
            'temporadas' => 'required|integer|min:1',
            'estado_emision' => 'required|string|max:255',
            'puntuacion_media' => 'required|numeric|min:0|max:10',
            'imagen' => 'required|url|max:255',
        ]);

        Serie::create($request->all());

        return redirect()->route('series.index')
            ->with('success', '¡La serie se ha creado correctamente!');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function agregarAPendientes(Request $request, Serie $serie)
    {
        $user = auth()->user();

        // Asegúrate de que el usuario tenga una lista de pendientes
        $listaPendientes = $user->listas()->firstOrCreate(
            ['nombre_lista' => 'Pendientes'],
            ['descripcion' => 'Lista de series pendientes'] // Proporciona un valor por defecto
        );

        // Adjunta la serie a la lista de pendientes
        $listaPendientes->series()->attach($serie->id);

        // No es necesario redirigir al usuario
    }


    public function calificar(Request $request, Serie $serie)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:1|max:10',
        ]);

        $calificacion = $request->input('calificacion');

        $nuevaCantidadVotos = $serie->cantidad_votos + 1;
        $nuevaPuntuacionMedia = (($serie->puntuacion_media * $serie->cantidad_votos) + $calificacion) / $nuevaCantidadVotos;

        $serie->cantidad_votos = $nuevaCantidadVotos;
        $serie->puntuacion_media = $nuevaPuntuacionMedia;
        $serie->save();

        return redirect()->route('series.show', $serie->id)
            ->with('success', 'Calificación registrada exitosamente.');
    }
    public function mostrarListaPendientes()
    {
        $user = auth()->user();

        // Obtener la lista de pendientes del usuario
        $listaPendientes = $user->listas()->where('nombre_lista', 'Pendientes')->first();

        // Obtener las series asociadas a la lista de pendientes
        $seriesPendientes = $listaPendientes ? $listaPendientes->series : collect();

        // Retornar la vista con las series pendientes
        return view('series.lista_pendientes', ['seriesPendientes' => $seriesPendientes]);
    }


    public function agregarAVistas(Request $request, Serie $serie)
    {
        $user = auth()->user();
        $user->vistas()->attach($serie->id);

        return redirect()->back()->with('success', 'Serie agregada a la lista de vistas.');
    }
    public function update(Request $request, Serie $serie)
    {
        // Validar los datos
        $validated = $request->validate([
            'imagen' => 'required|string',
            'titulo' => 'required|string|max:255',
            'sinopsis' => 'required|string',
            'genero' => 'required|string',
            'ano_lanzamiento' => 'required|integer',
            'temporadas' => 'required|integer',
            'estado_emision' => 'required|string',
            'puntuacion_media' => 'required|numeric'
        ]);

        // Actualizar la serie con los datos validados
        $serie->update($validated);

        // Redireccionar a la lista de series con un mensaje de éxito
        return redirect()->route('series.index')->with('success', 'Serie actualizada exitosamente.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        // Retorna la vista para editar una serie
        return view('series.edit', compact('serie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        // Verificar si el usuario es un administrador
        if (Auth::user() && Auth::user()->is_admin) {
            $serie->delete();
            return redirect()->route('series.index')
                ->with('success', 'Serie eliminada exitosamente.');
        }

        abort(403, 'No tienes permisos para eliminar esta película.');
    }
    // Método para ordenar las series según el criterio recibido  public function ordenarAnoAsc()

    public function show($id)
    {
        // Obtener la serie seleccionada
        $serie = Serie::findOrFail($id);

        // Obtener series relacionadas por género
        $seriesRelacionadasPorGenero = Serie::where('genero', $serie->genero)
            ->where('id', '!=', $id) // Excluir la serie seleccionada
            ->take(1) // Limitar a 5 series relacionadas
            ->get();



        return view('series.show', compact('serie', 'seriesRelacionadasPorGenero'));
    }
}

