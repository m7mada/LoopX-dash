<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Order;
use App\Models\Twin;

class OrderController extends Controller
{

    public function __construct()
    {
        $twinToken = config('app.twin_token');
        if ($twinToken !== request('twin_token')) {
            throw new \Exception('Wrong Twin Token');
        }
    }

    public function userCredit(int $userId)
    {
        $totalCredit = Order::query()
            ->where('orders.is_paid', 1)
            ->where('orders.user_id', $userId)
            ->join('order_lines', 'order_lines.order_id', '=', 'orders.id')
            ->join('benefits', 'benefits.id', '=', 'order_lines.benefit_id')
            ->where('benefits.type', 'cridet')
            ->sum('order_lines.value');

        $userTwins = Twin::query()
            ->where('user_id', $userId)
            ->pluck('twin_external_id')
            ->toArray();

        $usedCredit = Messages::query()
            ->where('role', 'assistant')
            ->whereIn("twin_id", $userTwins)
            ->sum("total_cost");

        $remaining = ($totalCredit - $usedCredit) * 0.65;
        return response()->json([
            'message' => 'Credit Details',
            'data' => [
                'total_credit' => $totalCredit,
                'remaining_credit' => $remaining,
            ]
        ]);
    }
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
