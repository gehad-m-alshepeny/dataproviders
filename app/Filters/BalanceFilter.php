<?php

namespace App\Filters;

use App\Contracts\FilterInterface;

class BalanceFilter implements FilterInterface
{
    protected $balanceMin;
    protected $balanceMax;

    public function __construct($balanceMin, $balanceMax)
    {
        $this->balanceMin = $balanceMin;
        $this->balanceMax = $balanceMax;
    }

    public function filter($data)
    {
        return collect($data)->filter(function ($item) {
            return $item['parentAmount'] >= $this->balanceMin && $item['parentAmount'] <= $this->balanceMax;
        });
    }
}
