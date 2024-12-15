<?php

namespace App\Http\Controllers;

use App\Models\AppleHistory;
use Illuminate\Http\Request;

class AppleHistoryController extends Controller
{

    public function index(Request $request)
    {
        $appleId = $request->query('apple_id');
        
        $query = AppleHistory::with(['history' => function($query) {
            $query->with('diseaseInfo'); // Assuming there's a relationship with disease info
        }]);
        
        // Filter by apple_id if provided
        if ($appleId) {
            $query->where('apple_id', $appleId);
        }
    
        $appleHistories = $query->latest()->paginate(10);
    
        return response()->json([
            'success' => true,
            'message' => 'Apple histories retrieved successfully!',
            'data' => $appleHistories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'apple_id' => 'required|exists:table_apple,id',
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
            'apple_id' => 'sometimes|exists:table_apple,id',
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
