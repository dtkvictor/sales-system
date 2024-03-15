<?php

namespace App\Http\Filters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ClientFilter extends Filter
{
    protected function filterAlias(): array
    {
        $oldAlias = parent::filterAlias();

        return [
            'search' => 'filterBySearch',
            'age' => 'filterByAge',
            'order-by' => 'orderBy',
        ];
    }

    protected function filterBySearch($value): Builder|Model
    {
        if(empty($value)) return $this->model;

        return $this->model->where('id', "$value")
                           ->orWhere('name', 'like', "%$value%")
                           ->orWhere('cpf', 'like', "%$value%");
    }

    protected function orderBy($value): Builder
    {
        $supported = [
            'name' => ['name', 'ASC'],
            'cpf' => ['cpf', 'ASC'],
            'age' => ['birth_date', 'DESC'],
        ];

        if(isset($supported[$value])) {
            return $this->model->orderBy(...$supported[$value]);
        }

        return $this->model->orderBy('updated_at', 'DESC');
    }
}