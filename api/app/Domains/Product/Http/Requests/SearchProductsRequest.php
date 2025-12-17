<?php

namespace App\Domains\Product\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

/**
 * @inheritDoc
 */
class SearchProductsRequest extends PageableProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            ...parent::rules(),
            "ids" => "nullable|array",
            "ids.*" => "string|ulid"
        ];
    }

    public function getIdFilters(): array {
        return $this->get("ids", []);
    }
}
