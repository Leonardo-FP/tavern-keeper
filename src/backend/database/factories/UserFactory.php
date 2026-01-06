<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        // Nomes temáticos (opcional)
        $nicknames = [
            'Arqueiro Sombrio',
            'Bardo Tagarela',
            'Clérigo da Aurora',
            'Ladino Brilhante',
            'Guardião do Abismo',
            'Invocador de Ratos',
            'Paladino do Trovão',
            'Mago do Norte'
        ];

        return [
            'name'      => $this->faker->name(),
            'email'     => $this->faker->unique()->safeEmail(),
            'nickname'  => $this->faker->randomElement($nicknames),
            'gender_id' => $this->faker->numberBetween(1, 5),
            'icon_id'   => $this->faker->numberBetween(1, 23),
            'password'  => Hash::make('password123'),
        ];
    }
}