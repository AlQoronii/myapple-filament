<?php

namespace App\Http\Controllers;

use App\Models\AppleHistory;
use Illuminate\Http\Request;

class AppleHistoryController extends Controller
{

    public function index()
    {
        $appleHistories = AppleHistory::paginate(10); // Pagination
        return response()->json([
            'success' => true,
            'message' => 'Apple histories retrieved successfully!',
            'data' => $appleHistories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'apple_id' => 'required|exists:apples,id',
            'history_id' => 'required|exists:history,id',
        ]);

        $appleHistory = AppleHistory::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Apple history created successfully!',
            'data' => $appleHistory,
        ]);
    }

    public function show($id)
    {
        $appleHistory = AppleHistory::find($id);

        if (!$appleHistory) {
            return response()->json([
                'success' => false,
                'message' => 'Apple history not found!',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Apple history retrieved successfully!',
            'data' => $appleHistory,
        ]);
    }

    public function update(Request $request, $id)
    {
        $appleHistory = AppleHistory::find($id);

        if (!$appleHistory) {
            return response()->json([
                'success' => false,
                'message' => 'Apple history not found!',
            ], 404);
        }

        $validated = $request->validate([
            'apple_id' => 'sometimes|exists:apples,id',
            'history_id' => 'sometimes|exists:history,id',
        ]);

        $appleHistory->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Apple history updated successfully!',
            'data' => $appleHistory,
        ]);
    }

    public function destroy($id)
    {
        $appleHistory = AppleHistory::find($id);

        if (!$appleHistory) {
            return response()->json([
                'success' => false,
                'message' => 'Apple history not found!',
            ], 404);
        }

        $appleHistory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Apple history deleted successfully!',
        ]);
    }
}
