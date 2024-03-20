<?php

namespace App\Factories;

use Illuminate\Support\Facades\Config;
use App\Contracts\DataProviderInterface;

class DataProviderFactory
{
    public static function create(string $provider): DataProviderInterface
    {

        $config = Config::get("dataproviders.$provider");
        if (!$config) {
            throw new \InvalidArgumentException("Provider $provider not found in configuration.");
        }
        return app()->make($config['class']);
    }
}
