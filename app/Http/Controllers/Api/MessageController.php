<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            ->paginate(
                perPage: $request->get('per_page', 50),
            );

        return response()->json($rows);
    }
}
