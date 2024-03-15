<?php

namespace Tests\Unit\Helpers;

use PHPUnit\Framework\TestCase;
use App\Helpers\StringUtils;

class StringUtilsTest extends TestCase
{
    public function test_slugToText_return_a_text(): void
    {
        $this->assertEquals('My slug', StringUtils::slugToText('my-slug'));
    }

    public function test_maskCPF_return_string_cpf_format(): void
    {
        $pattern = '/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/';
        $cpf = fake('pt_BR')->cpf(false);
        $this->assertMatchesRegularExpression($pattern, StringUtils::maskCPF($cpf));
    }

    public function test_maskPhoneNumberPtBr_return_string_phonenumber_format(): void
    {
        $pattern = '/^\(\d{2}\)\s\d{5}\-\d{4}$/';
        $phoneNumber = fake('pt_BR')->cellphoneNumber(false);
        $this->assertMatchesRegularExpression($pattern, StringUtils::maskPhoneNumberPtBr($phoneNumber));
    }


}
