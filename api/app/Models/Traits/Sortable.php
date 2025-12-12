<?php

namespace App\Models\Traits;

use App\Http\Requests\SortBy;
use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * @param Builder $query
     * @param SortBy[]|null $sortables
     * @param SortBy $default
     * @return Builder
     */
    public function scopeApplySortBy(Builder $query, ?array $sortables, SortBy $default): Builder
    {
        if($sortables == null){
            return $query->orderBy($default->col, $default->dir);
        }
        foreach ($sortables as $sortBy) {
            $query->orderBy($sortBy->col, $sortBy->dir);
        }
        return $query;
    }
}
