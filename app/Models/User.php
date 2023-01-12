<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Regras de validação
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ];

    }

    /**
     * Mensagens das regras de validação
     * @return array
     */
    public function feedback(): array
    {

        return [
            'required' => 'O campo :attribute é obrigatório',
            'name.min' => 'O nome de usuário deve ter no mínimo 3 caracteres',
            'password.min' => 'A senha deve ter no mínimo 8 caractres',
            'email.unique' => 'Esse e-mail já está sendo utilizado por outro usuário'
        ];

    }
}