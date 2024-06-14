<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'sinopsis',
        'genero',
        'ano_lanzamiento',
        'director',
        'imagen',
        'puntuacion_media',
        'cantidad_votos'
    ];
    public function plataformas()
    {
        return $this->belongsToMany(PlataformaStreaming::class, 'peliculas_plataformas', 'ID_pelicula', 'ID_plataforma');
    }
}
