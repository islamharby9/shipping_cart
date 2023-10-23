<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(): JsonResponse
    {
        $orderDetails = [];
        $items = Cart::query()->where('customer_id', 1);
        $orderDetails['items'] = CartResource::collection($items->get());
        $total = $items
            ->leftJoin('items', 'carts.item_id', '=', 'items.id')
            ->select('price')
            ->sum('price');
        $orderDetails['total_price_purchase'] = $total;

        $orderDetails['order_id'] = $this->store($total, 1);

        return apiSuccessResponse('success', $orderDetails);
    }

    /**
     * @param float $total
     * @param int $customerId
     * @return int
     */
    public function store(float $total, int $customerId): int
    {
        $order = Order::query()->where('customer_id', $customerId)->first();

        if (!$order) {
            $order = new Order();
            $order->customer_id = $customerId;
        }

        $order->total = $total;
        $order->save();

        return $order->id;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(UpdateOrderRequest $request): JsonResponse
    {
        $order = Order::query()->where('customer_id', 1)->where('id', $request->order_id)->first();
        $order->address = $request->address;
        $order->telephone = $request->telephone;
        $order->save();

        return apiSuccessResponse('Update order successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $orderId): JsonResponse
    {
        Order::query()->where('customer_id', 1)->where('id', $orderId)->delete();

        return apiSuccessResponse('Delete order successfully');
    }

    /**
     * @return JsonResponse
     */
    public function checkout(): JsonResponse
    {
        $customerCredit = Customer::query()->where('id', 1)->first();

        if ($customerCredit->store_credit < $customerCredit->orders->first()->total) {
            return apiErrorResponse(['This customer not enough credit'], 422);
        }

        $customerCredit->store_credit = $customerCredit->store_credit-$customerCredit->orders->first()->total;
        $customerCredit->save();

        return apiSuccessResponse('Order paid successfully');
    }
}
