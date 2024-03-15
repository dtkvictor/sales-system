<?php 

namespace App\Services\Sales;

class MonthlySalesService extends SalesService
{
    public function currentMonth(): MonthlySalesService
    {
        $currentMonth = (int) date('m');
        return $this->find($currentMonth);
    }
}