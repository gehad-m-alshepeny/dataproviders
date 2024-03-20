<?php

namespace App\Filters;

use App\Contracts\FilterInterface;
use Illuminate\Support\Collection;

class StatusFilter implements FilterInterface
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function filter($data)
    {
        return collect($data)->filter(function ($item) {
            return $item['status'] === $this->status;
        });
    }
}