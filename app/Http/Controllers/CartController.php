<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request): JsonResponse
    {
        $item = new Cart();
        $item->customer_id = 1;
        $item->item_id = $request->item_id;
        $item->quantity = $request->quantity;
        $item->save();

        return apiSuccessResponse('Add to cart successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(UpdateCartRequest $request): JsonResponse
    {
        $item = Cart::query()->where('customer_id', 1)->where('item_id', $request->item_id)->first();
        $item->quantity = $request->quantity;
        $item->save();

        return apiSuccessResponse('Update cart successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $itemId): JsonResponse
    {
        Cart::query()->where('customer_id', 1)->where('item_id', $itemId)->delete();

        return apiSuccessResponse('Delete form cart successfully');
    }
}
