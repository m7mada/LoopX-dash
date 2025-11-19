<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function latestOrders()
    {
        $response = [];
        $lastOrderLines = Order::query()
            ->when(request()->has('user_id'), function ($query) {
                $query->where('user_id', request()->user_id);
            })
            ->where('orders.is_paid', 1)
            ->join('order_lines', 'order_lines.order_id', '=', 'orders.id')
            ->whereNotNull('order_lines.expire_time')
            ->orderBy('orders.id','desc')
            ->select([
                'orders.id',
                'orders.user_id',
                'orders.is_paid',
                'orders.created_at',
                'order_lines.value'
            ])
            ->get()
            ->groupBy('user_id');

        foreach ($lastOrderLines as $userCollection) {
            $lastOrderLine = $userCollection->first();
            $response[] = [
                'order_id' => $lastOrderLine->id,
                'user_id' => $lastOrderLine->user_id,
                'expire_at' => $lastOrderLine->created_at->addMonths($lastOrderLine->value),
                'created_at' => $lastOrderLine->created_at->toDateTimeString(),
                'value' => $lastOrderLine->value,
            ];
        }
        return response()->json([
            'message' => 'Order Details',
            'data' => $response
        ]);
    }
}
