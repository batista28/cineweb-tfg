<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pelicula;
use App\Models\Serie;

class PlataformaStreaming extends Model
{
    protected $table = 'plataformas_streaming'; // Especificamos el nombre de la tabla

    protected $primaryKey = 'ID_plataforma'; // Especificamos la llave primaria

    protected $fillable = ['nombre_plataforma']; // Especificamos los campos fillable

    public $timestamps = true; // Indicamos que la tabla tiene timestamps

    public function peliculas()
    {
        return $this->belongsToMany(Pelicula::class, 'peliculas_plataformas', 'ID_plataforma', 'ID_pelicula');
        // Relación muchos a muchos con películas
    }

    public function series()
    {
        return $this->belongsToMany(Serie::class, 'series_plataformas', 'ID_plataforma', 'ID_serie');
        // Relación muchos a muchos con series
    }
}
