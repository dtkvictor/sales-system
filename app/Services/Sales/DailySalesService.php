<?php 

namespace App\Services\Sales;

class DailySalesService extends SalesService
{
    public function currentDay(): DailySalesService
    {
        $currentDay = date('d');
        return $this->find($currentDay);
    }
}