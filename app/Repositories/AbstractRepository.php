<?php

namespace App\Repositories;

use \Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{

    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Adiciona as colunas específicas que devem retornar (tebelas com relacionamento)
     * @param string $attributes
     * @return void
     */
    public function selectAttributesRelatedRecords(string $attributes): void
    {
        $this->model = $this->model->with($attributes);
    }

    /**
     * Adiciona condição de busca na query
     * @param string $filters
     * @return voide
     */
    public function filter(string $filters): void
    {
        $filters = explode(';',$filters);

        foreach($filters as $key => $conditions){
            $condition = explode(':', $conditions);                
            $this->model = $this->model->where($condition[0], $condition[1], $condition[2]);
        }
    }

    /**
     * Define quais colunas devem retornar da busca (de forma geral)
     * @param string $attributes
     * @return void
     */
    public function selectAttributes(string $attributes): void
    {
        $this->model = $this->model->selectRaw($attributes);
    }

    /**
     * Retorna os dados da consulta
     * @return mixed
     */
    public function getResults(): mixed
    {
        return $this->model->get();
    }

}