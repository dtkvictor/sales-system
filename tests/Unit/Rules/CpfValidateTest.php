<?php

namespace Tests\Unit\Rules;

use PHPUnit\Framework\TestCase;
use App\Rules\CpfValidate;

class CpfValidateTest extends TestCase
{
    public function test_cpf_validate_check_if_cpf_is_valid(): void
    {
        $validate = new CpfValidate();
        $validCPFGeneratedByAlgorithm = ['12916917071', '92119034087', '32684972095'];
        $cpf = $validCPFGeneratedByAlgorithm[rand(0,2)];

        $this->assertTrue($validate->validateCPF($cpf));
    }

    public function test_cpf_validate_check_if_cpf_is_not_repetition(): void
    {
        $validate = new CpfValidate();
        $fakeCpfs = ['11111111111', '22222222222', '33333333333'];
        $cpf = $fakeCpfs[rand(0,2)];

        $this->assertFalse($validate->validateCPF($cpf));
    }

    public function test_cpf_validate_check_if_cpf_that_exact_eleven_digits(): void 
    {
        $validate = new CpfValidate();
        $fakeCpfs = ['1234567890', '123456789123', '1'];
        $cpf = $fakeCpfs[rand(0,2)];

        $this->assertFalse($validate->validateCPF($cpf));
    }

    public function test_cpf_validate_check_if_cpf_is_just_numbers(): void 
    {
        $validate = new CpfValidate();
        $fakeCpfs = ['abc12312344', 'amvoedksrie', '123asd123qw'];
        $cpf = $fakeCpfs[rand(0,2)];

        $this->assertFalse($validate->validateCPF($cpf));
    }


}
