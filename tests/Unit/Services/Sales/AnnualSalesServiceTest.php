<?php

namespace Tests\Unit\Services\Sales;

use PHPUnit\Framework\TestCase;
use App\Services\Sales\AnnualSalesService;

class AnnualSalesServiceTest extends TestCase
{
    public array $salesData = [];
    public AnnualSalesService|null $salesService = null;
    
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->salesData = [
            '2021' => rand(1, 5),
            '2022' => rand(1, 10),
            '2023' => rand(1, 15),
            date('Y') => rand(1, 20)
        ];
        $this->salesService = new AnnualSalesService($this->salesData);
    }

    public function test_currentYear_return_this_year_sales_values()
    {
        $this->assertEquals(
            $this->salesData[date('Y')],
            $this->salesService->currentYear()->get()
        );
    }

    public function test_currentYear_injecting_empty_array()
    {
        $service = new AnnualSalesService([]);
        var_dump($service->currentYear()->get());
        $this->assertEquals(0, $service->currentYear()->get());
    }
}
