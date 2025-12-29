<?php

namespace App\Domains\Order\Http\Requests;

use App\Domains\Order\DataTransferObjects\CreateOrderDto;
use Illuminate\Foundation\Http\FormRequest;

class CompleteOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'orderId' => ['required', 'ulid'],
        ];
    }

    public function getOrderId(): string {
        return $this->validated()['orderId'];
    }

    public function authorize(): bool
    {
        return true;
    }
}
