<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    public function scopeBuscarPor($query, $eventoBusqueda, $campoTabla)
    {
        if(($eventoBusqueda) && ($campoTabla)){
            return $query->where($campoTabla, 'like', "%$eventoBusqueda%");
        }
        // if($eventoNombre){
        //     return $query->where('nombre_evento', 'like', "%$eventoNombre%");
        // }
    }
}
