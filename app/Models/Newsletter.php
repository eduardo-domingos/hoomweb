<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'news_content',
        'id_user',
    ];

    /**
     * Regras de validação
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:10|max:255',
            'news_content' => 'required',
            'id_user' => 'required'
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
            'title.min' => 'O Título deve ter no mínimo 10 caracteres',
            'title.max' => 'O Título deve ter no máximo 10 caracteres'  
        ];

    }

    /**
     * Adiciona relacionamento
     * Notícia depende do usuário para existir
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

}
