<?php
namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Validator;

class CreateNewUserWithPhone implements CreatesNewUsers
{
    /**
     * Cria um novo usuário na aplicação.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        // Validação do campo 'phone'
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:15', 'unique:users'], // Validando o campo 'phone'
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        // Criando o usuário
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'], // Salvando o campo 'phone'
            'password' => Hash::make($input['password']), // Criptografando a senha
        ]);
    }
}

