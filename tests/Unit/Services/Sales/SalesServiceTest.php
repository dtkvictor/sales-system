<?php

namespace Tests\Unit\Services\Sales;

use PHPUnit\Framework\TestCase;
use App\Services\Sales\SalesService;
use App\Helpers\NumberUtils;

class SalesServiceTest extends TestCase
{
    public array $salesData = [];
    public SalesService|null $salesService = null;
    
    public function __construct(...$args)
    {
        parent::__construct(...$args);
        $this->salesData = array_fill(0, 10, rand(1, 100));
        $this->salesService = new SalesService($this->salesData);
    }

    public function test_get_return_initial_sales_data()
    {
        $this->assertEquals($this->salesData, $this->salesService->get());
    }

    public function test_find_return_selected_sales_data_by_key()
    {
        $this->assertEquals(
            $this->salesData[2], 
            $this->salesService->find(2)->get()
        );
    }

    public function test_sum_calculate_and_return_the_total_sales_value()
    {
        $this->assertEquals(
            array_sum($this->salesData), 
            $this->salesService->sum()->get()
        );
    }

    public function test_toJson_convert_sales_data_to_json()
    {
        $this->assertEquals(
            json_encode($this->salesData), 
            $this->salesService->toJson()->get()
        );
    }

    public function test_format_format_a_number_with_grouped_thousands()
    {
        $this->assertEquals(
            number_format(array_sum($this->salesData), 2), 
            $this->salesService->sum()->format(2)->get()
        );
    }

    public function test_abbreviate_abbreviates_and_returns_the_total_sales_value()
    {
        $this->assertEquals(
            NumberUtils::abbreviateNumber(array_sum($this->salesData)), 
            $this->salesService->sum()->abbreviate()->get()
        );
    }

    public function test_injecting_empty_array()
    {
        $service = new SalesService([]);
        $this->assertEquals([], $service->get());
    }

    public function test_sum_with_empty_array()
    {
        $service = new SalesService([]);
        $this->assertEquals(0, $service->sum()->get());
    }

}
