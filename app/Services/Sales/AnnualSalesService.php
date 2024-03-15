<?php 

namespace App\Services\Sales;

class AnnualSalesService extends SalesService
{
    public function currentYear(): AnnualSalesService
    {
        $currentYear = date('Y');
        return $this->find($currentYear);
    }
}