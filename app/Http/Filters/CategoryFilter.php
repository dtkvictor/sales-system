<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CategoryFilter extends Filter
{
    protected function filterAlias(): array
    {
        $oldAlias = parent::filterAlias();

        return [
            'search' => 'filterByName',
            'date' => 'filterByUpdatedAt',
            'order-by' => 'orderBy'
        ];
    }
}