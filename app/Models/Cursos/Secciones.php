<?php

namespace App\Models\Cursos;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secciones extends Model
{
    use HasFactory;
    use CreatedUpdatedBy;

    protected $table = "cursos_seccione";

    protected $fillable = ["titulo"];
}
