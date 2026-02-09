<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conversations;
use App\Models\Messages;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->header('Secret-Token') !== config('app.twin_token')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rows = Messages::query()
            ->where(function (Builder $query) use ($request) {
                if ($request->has('role')) {
                    $query->where('role', $request->get('role'));
                }

                if ($request->has('twin_id')) {
                    $query->where('twin_id', $request->get('twin_id'));
                }
            })
            ->orderBy(
                column: $request->get('order_by', 'created_at'),
                direction: $request->get('order_direction', 'desc'),
            )
            ->paginate(
                perPage: (int) $request->get('per_page', 1000),
            );

        return response()->json($rows);
    }


    public function pausedConversations(Request $request)
    {
        if ($request->header('Secret-Token') !== config('app.twin_token')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $rows = Conversations::query()
            ->where(function (Builder $query) use ($request) {
                if ($request->has('twin_id')) {
                    $query->where('twin_id', $request->get('twin_id'));
                }

                if ($request->has('conversation_id')){
                    $query->where('conversation_id', $request->get('conversation_id'));
                }
            })
            ->orderBy(
                column: $request->get('order_by', 'id'),
                direction: $request->get('order_direction', 'desc'),
            )
            ->paginate(
                perPage: (int) $request->get('per_page', 1000),
            );

        return response()->json($rows);
    }
}
