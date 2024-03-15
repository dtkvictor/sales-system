<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use DateTime;
use App\Helpers\StringUtils;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;

    public function shopping(): HasMany
    {
        return $this->hasMany(Sale::class, 'client_id', 'id');
    } 

    public function getCurrentAge()
    {
        $today = new DateTime();
        $birth_date = new DateTime($this->birth_date);
        $age = $today->diff($birth_date);
        $this->setAttribute('age', $age->y);
    }

    public function getCpfWithMask() 
    {
        $cpfMask = StringUtils::maskCPF($this->getAttribute('cpf'));
        $this->setAttribute('cpf', $cpfMask);
    }

    public function getPhoneNumberWithMask()
    {
        $phoneMask = StringUtils::maskPhoneNumberPtBR($this->getAttribute('phone_number'));
        $this->setAttribute('phone_number', $phoneMask);
    }

    public function getListShoppings()
    {
        $shoppings = $this->shopping()
                          ->with('items.product')
                          ->withSum('items as total_amount', DB::raw('unit_price * amount'))
                          ->orderBy('created_at', 'DESC')
                          ->paginate(6);
        $this->setAttribute('shoppings', $shoppings);
    }
}