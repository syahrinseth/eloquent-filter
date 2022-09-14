<?php

namespace SyahrinSeth\EloquentFilter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SyahrinSeth\EloquentFilter\EloquentFilter
 */
class EloquentFilter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \SyahrinSeth\EloquentFilter\EloquentFilter::class;
    }
}
