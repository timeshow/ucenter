<?php
namespace TimeShow\UCenter\Facades;

use Illuminate\Support\Facade;

class UCenter extends Facade
{
    protected static function getFacadeAccessor(){
        return 'ucenter';
    }
}