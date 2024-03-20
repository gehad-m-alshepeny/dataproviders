<?php

namespace App\Filters;

use App\Contracts\FilterInterface;

class CurrencyFilter implements FilterInterface
{
    protected $currency;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    public function filter($data)
    {
        return collect($data)->filter(function ($item) {
            return $item['currency'] === $this->currency;
        });
    }
}