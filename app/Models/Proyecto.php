<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    function users(){
        return $this->hasMany(User::class);
    }

    function etapas(){
        return $this->hasMany(Etapas::class);
    }
}
