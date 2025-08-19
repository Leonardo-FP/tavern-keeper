<?php

namespace Tests\Feature;

use Illuminate\Support\Str;
use \App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_can_register_with_valid_credentials(): void
    {
        $name = $this->faker->name();
        $email = $this->faker->unique()->safeEmail;
        $password = 'User@1234';

        $response = $this->postJson('/api/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response   
            ->assertSuccessful()
            ->assertJsonStructure([
                'message',
                'token',
                'user' => [
                    'id',
                    'name',
                    'email'
                ],
            ]);

        $responseContent = $response->json();

        $response->assertJson([
            'message' => 'Usuário criado com sucesso! Seja bem vindo(a).',
            'user' => [
                'name' => $name,
                'email' => $email,
            ],
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
        ]);
    }

    public function test_user_cannot_register_with_name_too_long(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => Str::random(256), // Supondo que o limite é 255
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'Senha@1234',
            'password_confirmation' => 'Senha@1234',
        ]);

        $response->assertStatus(422) // Verifica se o status é de erro de validação
            ->assertInvalid(['name']); // Garante que apenas o campo 'name' foi invalidado
    }

    public function test_user_cannot_register_with_invalid_email(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => $this->faker->word(), // Apenas uma palavra, não é um e-mail válido
            'password' => 'Senha@1234',
            'password_confirmation' => 'Senha@1234',
        ]);

        $response->assertStatus(422)
            ->assertInvalid(['email']);
    }

    public function test_user_cannot_register_with_weak_password(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => '12345678', // Senha fraca
            'password_confirmation' => '12345678',
        ]);

        $response->assertStatus(422)
            ->assertInvalid(['password']);
    }

    public function test_user_cannot_register_with_already_existing_email(): void
    {
        // Crie um e-mail seguro e válido com o Faker.
        $existingEmail = $this->faker->unique()->safeEmail;

        $user = User::factory()->create([
            'email' => $existingEmail,
            'password' => Hash::make('Senha@1234'),
        ]);

        $response = $this->postJson('/api/register', [
            'name' => $this->faker->name(),
            'email' => $existingEmail, // E-mail repetido de um usuário que já existe
            'password' => 'Senha@1234', 
            'password_confirmation' => 'Senha@1234',
        ]);

        $response->assertStatus(422)
            ->assertInvalid(['email']);
    }
}