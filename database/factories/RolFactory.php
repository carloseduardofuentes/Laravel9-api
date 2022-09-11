<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rol;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{

    protected $model = Rol::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rol' => $this->faker->name()
        ];
    }
}
