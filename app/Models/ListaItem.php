<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListaItem extends Model
{
    use HasFactory;

    protected $fillable = ['ID_lista', 'pelicula_id', 'serie_id', 'estado'];

    public function lista()
    {
        return $this->belongsTo(Lista::class, 'ID_lista');
    }

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
