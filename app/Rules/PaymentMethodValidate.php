<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PaymentMethodValidate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $paymentMethod = explode('.', $value);

        if($paymentMethod[0] != 'credit_card') {
            $fail('Invalid payment method.');
        }
        if(!isset($paymentMethod[1])) {
            $fail('Invalid installment option.');
        }elseif ($paymentMethod[1] < 0 || $paymentMethod[1] > 12){
            $fail('Invalid installment option.');
        }
    }
}
