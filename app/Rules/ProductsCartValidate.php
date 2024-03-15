<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Product;

class ProductsCartValidate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $shoppingCart = json_decode($value);

        foreach($shoppingCart as $item) {
            if(!$product = Product::find($item->id)) {
                $fail("Product id: {$item->id} not found");
                return;
            }
            if($product->inventory < $item->amount) {
                $fail("You have exceeded the quantity in stock of the product: {$item->id}");
                return;
            }
        }
    }
}
