<?php

namespace SyahrinSeth\EloquentFilter;

use Illuminate\Contracts\Database\Query\Builder;

trait EloquentFilter
{
    public static function scopeFilter(Builder $query, QueryFilter $filter): Builder
    {
        return $filter->apply($query);
    }
}
