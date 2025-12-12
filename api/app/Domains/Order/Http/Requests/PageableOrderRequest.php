<?php

namespace App\Domains\Order\Http\Requests;

use App\Http\Requests\SortablePaginationRequest;

/**
 * @inheritDoc
 */
class PageableOrderRequest extends SortablePaginationRequest
{
    public function sortableColumns(): array
    {
        return [
            'created_at'
        ];
    }
}
