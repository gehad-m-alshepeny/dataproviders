<?php

namespace App\Contracts;

interface DataProviderInterface
{
    public function getUsers(): array;
}