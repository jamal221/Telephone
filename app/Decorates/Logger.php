<?php


namespace App\Decorates;


use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class Logger
{
    function LogMethodCall($callable){
        return function ($param) use ($callable){
        $result=app()->call($callable,[$param]);
        Log::info('param is:  '.implode(',',$param).'and result is: '.$result);
        };

    }

}
