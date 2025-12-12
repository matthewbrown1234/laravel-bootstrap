<?php

namespace App\Domains\Product\Http\Requests;

use App\Http\Requests\SortablePaginationRequest;

/**
 * @inheritDoc
 */
class PageableProductRequest extends SortablePaginationRequest
{
    public function sortableColumns(): array
    {
        return [
            'name',
            'created_at'
        ];
    }
}
