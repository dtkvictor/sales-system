<?php

namespace Tests\Unit\Services\Sales;

use PHPUnit\Framework\TestCase;
use App\Services\Sales\MonthlySalesService;

class MonthlySalesServiceTest extends TestCase
{
    public array $salesData = [];
    public MonthlySalesService|null $salesService = null;
    
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->salesData = array_fill(1, 12, 0);
        $this->salesService = new MonthlySalesService($this->salesData);
    }

    public function test_currentMonth_return_this_month_sales_values()
    {
        $currentMount = (int) date('m');
        $this->assertEquals(
            $this->salesData[$currentMount],
            $this->salesService->currentMonth()->get()
        );
    }

    public function test_currentMonth_injecting_empty_array()
    {
        $service = new MonthlySalesService([]);
        $this->assertEquals(0, $service->currentMonth()->get());
    }
}
