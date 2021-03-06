<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Curso::class;


    public function definition()
    {
        $titulo = $this->faker->name();
        return [
            'imagen' => $this->faker->imageUrl($width = 300, $height = 300),
            'nombre' => $titulo,
            'slug'  => Str::slug( $titulo , '-'),
            'descripcion_larga' => $this->faker->realText($maxNbChars = 200,),
            'descripcion_corta' => $this->faker->realText($maxNbChars = 100,),
            'precio' => $this->faker->randomFloat($nbMaxDecimals=2, $min = 10, $max = 100),
            'user_id' => '1',
            'cursos_categoria_id' => $this->faker->randomDigitNotNull(),
            'author_id' => $this->faker->randomDigitNotNull(),
        ];
    }
}
