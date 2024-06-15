<?php

namespace App\Http\Controllers;

use App\Models\PlataformaStreaming;
use App\Models\Pelicula;
use App\Models\Serie;
use Illuminate\Http\Request;

class PlataformaController extends Controller
{
    public function index()
    {
        $plataformas = PlataformaStreaming::all();
        return view('plataformas.index', compact('plataformas'));
    }

    public function show($id)
    {
        $plataforma = PlataformaStreaming::findOrFail($id);
        $plataforma->load('peliculas', 'series');
        return view('plataformas.show', compact('plataforma'));
    }

    public function addContent($id)
    {
        $plataforma = PlataformaStreaming::findOrFail($id);
        $peliculas = Pelicula::all();
        $series = Serie::all();
        return view('plataformas.add_content', compact('plataforma', 'peliculas', 'series'));
    }

    public function storeContent(Request $request, $id)
    {
        $plataforma = PlataformaStreaming::findOrFail($id);

        // Guardar películas
        if ($request->has('peliculas')) {
            $plataforma->peliculas()->syncWithoutDetaching($request->input('peliculas'));
        }

        // Guardar series
        if ($request->has('series')) {
            $plataforma->series()->syncWithoutDetaching($request->input('series'));
        }

        return redirect()->route('plataformas.show', $id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_plataforma' => 'required|unique:plataformas_streaming,nombre_plataforma',
        ]);

        PlataformaStreaming::firstOrCreate([
            'nombre_plataforma' => $request->nombre_plataforma,
        ]);

        // Redireccionar o realizar alguna acción después de la creación
    }
}