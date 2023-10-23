<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateOrderRequest extends ResponseRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_id' => ['required', 'exists:orders,id', function ($att, $val, $fail) {

                if (!Order::query()
                    ->where('customer_id', 1)
                    ->where('id', $val)
                    ->first()) {
                    $fail('This order not found for this customer.');
                }
            }],
            'address' => ['required', 'string', 'max:100'],
            'telephone' => ['required', 'string', 'max:11']
        ];
    }
}
