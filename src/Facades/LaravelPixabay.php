<?php

namespace Joukhar\LaravelPixabay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Joukhar\LaravelPixabay\LaravelPixabay
 */
class LaravelPixabay extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Joukhar\LaravelPixabay\LaravelPixabay::class;
    }
}
