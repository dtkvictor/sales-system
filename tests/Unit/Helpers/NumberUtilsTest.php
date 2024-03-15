<?php

namespace Tests\Unit\Helpers;

use PHPUnit\Framework\TestCase;
use App\Helpers\NumberUtils;

class NumberUtilsTest extends TestCase
{
    public function test_method_abbreviate_number(): void
    {
        $this->assertEquals(500, NumberUtils::abbreviateNumber(500));

        $this->assertMatchesRegularExpression('/^\d+(\.\d+)?(?:K|M|B|T)$/', 
            NumberUtils::abbreviateNumber(rand(1000, 1000000000))
        );
    }
}
