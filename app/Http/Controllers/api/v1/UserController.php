<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Factories\DataProviderFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = $request->perPage ?? 10;
        $provider= $request->provider ?? null;
        $data = [];

        $provider ? $providers = [$request->provider] : $providers = array_keys(Config::get('dataproviders'));

        foreach ($providers as $providerName) {
            $dataProvider = DataProviderFactory::create($providerName);
            $data = array_merge($data, $dataProvider->getUsers());
        }

        $data = collect($this->filterData($data,$request))->forPage($page,$perPage)->values();

        return response()->json($data);
        
    }

    public function filterData($data, $request)
    {
        if (isset($request['status'])) {
            $data = (new \App\Filters\StatusFilter($request['status']))->filter($data);
        }
        if (isset($request['currency'])) {
            $data = (new \App\Filters\CurrencyFilter($request['currency']))->filter($data);
        }
        if (isset($request['balanceMin']) && isset($request['balanceMax'])) {
            $data = (new \App\Filters\BalanceFilter($request['balanceMin'], $request['balanceMax']))->filter($data);
        }
    
        return $data;
    }
    
}
