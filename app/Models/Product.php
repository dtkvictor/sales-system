<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumb',
        'name',
        'price',
        'description',
        'inventory',
        'category'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(ItemSale::class, 'product_id', 'id');
    }

}
