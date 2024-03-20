<?php

namespace App\DataProviders;

use App\Contracts\DataProviderInterface;
use Cerbero\JsonParser\JsonParser;


class DataProviderY implements DataProviderInterface
{

    protected $statusMap;

    public function __construct()
    {
        $this->statusMap = [
            100 => 'authorised',
            200 => 'decline',
            300 => 'refunded',
        ];
    }

    public function getUsers(): array
    {
        $data = [];
        try {
            $jsonParser = new JsonParser(storage_path('app/data/dataproviderY.json'));
           // instead of loading the whole JSON, we keep in memory only one key and value at a time
            $jsonParser->traverse(function ($value, $key, JsonParser $parser) use (&$data) {
                $status = $this->statusMap[$value['status']] ?? 'unknown';
                $value['status'] = $status;
                $data[] = $value;
            });
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error occurred in DataProviderX: ' . $e->getMessage());
        }

        return $data;
    }
}