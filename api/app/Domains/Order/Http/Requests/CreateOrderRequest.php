<?php

namespace App\Domains\Order\Http\Requests;

use App\Domains\Order\DataTransferObjects\CreateOrderDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items' => ['required', 'array', 'min:1'],
            'items.*.extProductId' => ['required', 'ulid'],
        ];
    }

    public function toDto(): CreateOrderDto {
        return CreateOrderDto::fromRequest($this->validated());
    }

    public function authorize(): bool
    {
        return true;
    }
}
