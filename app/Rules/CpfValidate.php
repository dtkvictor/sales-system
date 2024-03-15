<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfValidate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->validateCPF($value)) return;
        $fail('The CPF entered is not valid');
    }

    /**
     * Checks if the cpf is valid
     * @param number cpf
     * @return bool
     */

    public function validateCPF(string $cpf): bool
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if(strlen($cpf) != 11) return false;
        if(preg_match('/(\d)\1{10}/', $cpf)) return false;

        $firstDigit = $this->calculateDigit(9, 10, $cpf);
        if($firstDigit != $cpf[9]) return false;

        $secondDigit = $this->calculateDigit(10, 11, $cpf);
        if($secondDigit != $cpf[10]) return false;

        return true;
    }

    /**
     * Calculation of CPF digits
     * @param int $len
     * @param int $countdown 
     * @param string $cpf
     * @result int $digit
    */

    public function calculateDigit($len, $countdown, $cpf): int 
    {
        $result = 0;

        for($num = 0; $num < $len; $num++) {
            $result += ($cpf[$num] * $countdown);
            $countdown--;
        }

        $digit = (($result * 10) % 11);
        return ($digit < 10 ? $digit : 0);
    }
}
