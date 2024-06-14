<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_lista', 'descripcion', 'ID_usuario'];
    protected $primaryKey = 'ID_lista';
    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_usuario');
    }

    public function items()
    {
        return $this->hasMany(ListaItem::class, 'ID_lista');
    }
}
