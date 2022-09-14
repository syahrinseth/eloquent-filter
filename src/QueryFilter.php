<?php

namespace SyahrinSeth\EloquentFilter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

abstract class QueryFilter
{
    protected $request;

    protected $builder;

    protected $filterable = [];

    /**
     * QueryFilter constructor.
     *
     * @param  Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;
        $this->filterable = $filterable ?? $this->getTableColumns();

        foreach ($this->filters() as $name => $value) {
            // Get list of columns
            if (in_array($name, $this->filterable)) {
                if (method_exists($this, $name)) {
                    call_user_func_array([$this, $name], array_filter([$value]));
                } else {
                    $this->builder->orWhere($name, 'LIKE', "%{$value}%");
                }
            }
        }

        return $this->builder;
    }

    public function filters(): array
    {
        return $this->request->all();
    }

    /**
     * Get table columns
     *
     * @return array
     */
    protected function getTableColumns(): array
    {
        $columns = Schema::getColumnListing($this->builder->getModel()->getTable());

        return $columns;
    }

    /**
     * Get table name.
     *
     * @return string
     */
    protected function getTableName(): string
    {
        return $this->builder->getModel()->getTable();
    }

    protected function sort_column($field)
    {
        if ($this->request->has(['sort_direction'])) {
            return $this->builder->orderBy($field, $this->request->input('sort_direction') ?? 'asc');
        }

        return $this->builder;
    }

    public function search($input = null)
    {
        $filterable = $this->filterable;

        return $this->builder->where(function ($query) use ($input, $filterable) {
            for ($i = 0; count($filterable) > 0; $i++) {
                if ($i == 0) {
                    $query->where($filterable[$i], 'like', "%{$input}%");
                } else {
                    $query->orWhere($filterable[$i], 'like', "%{$input}%");
                }
            }
        });
    }
}
