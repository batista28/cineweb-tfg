<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
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
        'cantidad_votos',
        'temporadas',
        'estado_emision',
    ];
    public function plataformas()
    {
        return $this->belongsToMany(PlataformaStreaming::class, 'series_plataformas', 'ID_serie', 'ID_plataforma');
    }
}
