<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle user login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Carrega o relacionamento que trás os dados do ícone de perfil
        $user->load('icon');
        // Carrega o relacionamento que trás os dados do gênero do usuário
        $user->load('gender');

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'token' => $token,
            'user' => $user, 
        ]);
    }

    public function register(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation' => ['required']
        ]);

        // Garante que a senha seja hasheada de forma segura
        $validated['password'] = Hash::make($validated['password']);

        // Remove o campo de confirmação da senha antes de criar o usuário
        unset($validated['password_confirmation']);

        try{
            $user = User::create($validated);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Usuário criado com sucesso! Seja bem vindo(a).',
                'token' => $token,
                'user' => $user,
            ]);

        } catch(Exception $e){
            return response()->json(['message' => 'Erro ao criar usuário']);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Deslogado com sucesso!']);
    }
}
