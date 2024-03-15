<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use Carbon\Carbon;

class SaleFilter extends Filter
{
    protected function filterAlias(): array
    {
        $oldAlias = parent::filterAlias();

        return [
            'search' => 'filterBySearch',
            'date' => 'filterByUpdatedAt',
            'min' => 'filterByMinValue',
            'max' => 'filterByMaxValue',
            'my-sales' => 'filterByMySales',
            'hour' => 'filterByHour',
            'order-by' => 'orderBy'
        ];
    }

    protected function filterByMinValue($min): Builder|Model
    {
        if(is_numeric($min)) {
            return $this->model->where('total_amount', '>=', $min);
        }
        return $this->model;
        
    }

    protected function filterByMaxValue($max): Builder|Model
    {
        if(is_numeric($max)) {
            return $this->model->where('total_amount', '<=', $max);
        }
        return $this->model;
    }

    protected function filterBySearch($value): Builder|Model
    {
        if(empty($value)) return $this->model;

        return $this->model->where('id', "$value")
                           ->orWhere('payment_method', 'like', "$value")
                           ->orWhereHas('user', function($query) use ($value) {
                                $query->where('name', 'like', "%$value%");
                            });
    }

    protected function filterByMySales($value): Builder
    {
        if($value == 'on' && auth()->check()) {
            return $this->model->where('user', auth()->id());
        }
        return $this->model->where('user', 0);
    }

    protected function filterByPaymentMethod($payment_method): Builder
    {
        return $this->model->where('payment_method', $payment_method);
    }

    public function filterByHour($hour): Builder|Model
    {
        if(strtotime($hour)) {
            return $this->model->whereTime('updated_at', Carbon::parse($hour)->toTimeString());
        }
        return $this->model;
    }

    protected function orderBy($value): Builder
    {
        $supported = [
            'total_amount.low' => ['total_amount', 'ASC'],
            'total_amount.big' => ['total_amount', 'DESC'],
        ];

        if(isset($supported[$value])) {
            return $this->model->orderBy(...$supported[$value]);
        }

        return $this->model->orderBy('updated_at', 'DESC');
    }
}