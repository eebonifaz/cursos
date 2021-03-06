<?php

namespace App\Models\Cursos;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    use CreatedUpdatedBy;

    protected $table = "cursos_categorias";

    protected $fillable = [
        "imagen",
        "nombre"
    ];
}
