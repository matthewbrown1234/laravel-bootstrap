<?php

namespace App\Domains\Product\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class SearchProductsRequest extends PageableProductRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "ids" => "nullable|array",
            "ids.*" => "string|ulid"
        ];
    }

    public function getIdFilters(): array {
        return $this->get("ids", []);
    }
}
