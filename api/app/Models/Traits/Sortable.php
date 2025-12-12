<?php

namespace App\Models\Traits;

use App\Http\Requests\SortBy;
use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * @param Builder $query
     * @param SortBy[]|null $sortables
     * @return Builder
     */
    public function scopeApplySortBy(Builder $query, ?array $sortables): Builder
    {
        if($sortables == null){
            return $query;
        }
        foreach ($sortables as $sortBy) {
            $query->orderBy($sortBy->col, $sortBy->dir);
        }
        return $query;
    }
}
