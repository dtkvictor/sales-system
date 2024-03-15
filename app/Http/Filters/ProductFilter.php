<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductFilter extends Filter
{
    protected function filterAlias(): array
    {
        $oldAlias = parent::filterAlias();

        return [
            'search' => 'filterByName',
            'date' => 'filterByUpdatedAt',
            'min' => 'filterByMinPrice',
            'max' => 'filterByMaxPrice',
            'category' => 'filterByCategory',
            'order-by' => 'orderBy'
        ];
    }

    protected function filterByMinPrice($min): Builder|Model
    {
        if(is_numeric($min)) {
            return $this->model->where('price', '>=', $min);
        }
        return $this->model;
        
    }

    protected function filterByMaxPrice($max): Builder|Model
    {
        if(is_numeric($max)) {
            return $this->model->where('price', '<=', $max);
        }
        return $this->model;
    }

    protected function filterByCategory($category): Builder|Model
    {
        if(is_numeric($category) && $category > 0) {
            return $this->model->where('category', $category);
        }
        return $this->model;
    } 

    protected function orderBy($value): Builder
    {
        $supported = [
            'price.low' => ['price', 'ASC'],
            'price.big' => ['price', 'DESC'],
            'quantity.less' => ['inventory', 'ASC'],
            'quantity.greater' => ['inventory', 'DESC']
        ];

        if(isset($supported[$value])) {
            return $this->model->orderBy(...$supported[$value]);
        }

        return $this->model->orderBy('updated_at', 'DESC');
    }
}