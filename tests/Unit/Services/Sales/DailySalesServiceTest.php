<?php

namespace Tests\Unit\Services\Sales;

use PHPUnit\Framework\TestCase;
use App\Services\Sales\DailySalesService;

class DailySalesServiceTest extends TestCase
{
    public array $salesData = [];
    public DailySalesService|null $salesService = null;
    
    public function __construct(...$args)
    {
        parent::__construct(...$args);

        $days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $this->salesData = array_fill(1, $days, rand(1, 1000));
        $this->salesService = new DailySalesService($this->salesData);
    }

    public function test_currentDay_return_this_day_sales_values()
    {
        $this->assertEquals(
            $this->salesData[date('d')],
            $this->salesService->currentDay()->get()
        );
    }

    public function test_currentDay_injecting_empty_array()
    {
        $service = new DailySalesService([]);
        $this->assertEquals(0, $service->currentDay()->get());
    }
}
