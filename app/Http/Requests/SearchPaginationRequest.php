<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchPaginationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function getPage(): int
    {
        return $this->query('page', 1);
    }

    public function getPerPage(): int
    {
        return $this->query('per_page', 10);
    }
}
