<?php

namespace App\Http\Requests;

use App\Models\Cart;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
            'item_id' => ['required', 'exists:items,id', function ($att, $val, $fail) {

                if (!Cart::query()
                    ->where('customer_id', 1)
                    ->where('item_id', $val)
                    ->first()) {
                    $fail('This item not found with this customer.');
                }
            }],
            'quantity' => ['required', 'numeric', 'min:1']
        ];
    }
}
