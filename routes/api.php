<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\UserController;


Route::group(['prefix' => '/v1'], function () 
{
  Route::get('/users',[UserController::class,'index']);
});
