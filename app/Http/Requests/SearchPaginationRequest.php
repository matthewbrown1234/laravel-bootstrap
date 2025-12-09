<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchPaginationRequest extends FormRequest
{
    public function pagination(): PaginationData
    {
        return PaginationData::fromRequest($this);
    }
}
