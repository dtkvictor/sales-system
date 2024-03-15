<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Sale extends Model
{
    use HasFactory;

    public static function paymentMethod(): array
    {
        return ['credit_card', 'money'];
    }

    public static function optionParcels(): array
    {
        return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    }

    public function items():HasMany
    {
        return $this->hasMany(ItemSale::class, 'sale_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function annualSales(): array
    {
        return self::selectRaw('YEAR(sales.created_at) as year, SUM(item_sales.amount * item_sales.unit_price) as total_amount')
                    ->join('item_sales', 'sales.id', '=', 'item_sales.sale_id')
                    ->groupBy('year')
                    ->get()
                    ->pluck('total_amount', 'year')
                    ->toArray();
    }

    public function monthlySales(): array
    {
        $monthlySales = array_fill(1, 12, 0);

        $sales = self::selectRaw('MONTH(sales.created_at) as month, SUM(item_sales.amount * item_sales.unit_price) as total_amount')
                    ->join('item_sales', 'sales.id', '=', 'item_sales.sale_id')
                    ->whereYear('sales.created_at', date('Y'))
                    ->groupBy('month')
                    ->get();

        foreach($sales as $sale) {
            $monthlySales[$sale->month] = $sale->total_amount;
        }

        return $monthlySales;
    }

    public function dailySales(): array
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
        $dailySales = array_fill(1, $daysInMonth, 0);
         
        $sales = self::selectRaw('DAY(sales.created_at) as day, SUM(item_sales.amount * item_sales.unit_price) as total_amount')
                    ->join('item_sales', 'sales.id', '=', 'item_sales.sale_id')
                    ->whereYear('sales.created_at', $currentYear)
                    ->whereMonth('sales.created_at', $currentMonth)
                    ->groupBy('day')
                    ->get();
        
        foreach($sales as $sale) {
            $dailySales[$sale->day] = $sale->total_amount;
        }

        return $dailySales;
    }
}
