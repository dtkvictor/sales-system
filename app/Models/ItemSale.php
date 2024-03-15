<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemSale extends Model
{
    use HasFactory;

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id')->select('id', 'name');
    }

    public static function topSellingProducts(): array
    {
        $topSellingProducts = [];
        $itemSale = self::selectRaw('products.name, COUNT(*) AS total_sales')
                        ->join('products', 'item_sales.product_id', '=', 'products.id')
                        ->groupBy('products.name')
                        ->orderBy('total_sales', 'DESC')
                        ->limit(3)
                        ->get();

        foreach($itemSale as $item) {
            $topSellingProducts[$item->name] = $item->total_sales;
        }

        return $topSellingProducts;
    }
}
