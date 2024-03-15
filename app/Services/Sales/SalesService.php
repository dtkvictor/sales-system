<?php

namespace App\Services\Sales;
use App\Helpers\NumberUtils;

class SalesService
{
    private array $sales = [];
    private mixed $cache = null;

    public function __construct(array $sales)
    {
        $this->sales = $sales;
    }

    protected function getSales()
    {
        return $this->sales;
    }

    protected function getCache() 
    {
        return $this->cache;
    }

    protected function setCache($cache)
    {
        $this->cache = $cache;
    }

    protected function clearCache()
    {
        $this->cache = null;
    }

    public function get(): mixed
    {
        if(($result = $this->getCache()) === null) {
           return $this->getSales();
        }
        $this->clearCache();
        return $result;
    }

    public function find($key): SalesService
    {
        $sales = $this->getSales();
        
        if(isset($sales[$key])) {
            $this->setCache($sales[$key]);
        }else {
            $this->setCache(0);
        }

        return $this;
    }

    public function sum(): SalesService
    {
        $this->setCache(
            array_sum($this->getSales())
        );
        return $this;
    }

    public function toJson(): SalesService
    {
        $this->setCache(
            json_encode($this->getSales())
        );
        return $this;
    }
    
    public function format(int $decimals = 0, string $dec_point = ".", string $thousands_sep = ","): SalesService
    {
        $this->setCache(
            number_format($this->getCache(), $decimals, $dec_point, $thousands_sep)
        );
        return $this;
    }

    public function abbreviate(): SalesService
    {
        $this->setCache(
            NumberUtils::abbreviateNumber($this->cache)
        );
        return $this;
    }

}