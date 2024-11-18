<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::paginate(10); // Pagination
        return response()->json([
            'success' => true,
            'message' => 'Histories retrieved successfully!',
            'data' => $histories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'scan_date' => 'required|date',
            'scan_image_path' => 'required|string|max:255',
            'disease_info_id' => 'required|exists:categories,id',
        ]);

        $history = History::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'History created successfully!',
            'data' => $history,
        ], 201);
    }

    public function show($id)
    {
        $history = History::find($id);

        if (!$history) {
            return response()->json([
                'success' => false,
                'message' => 'History not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'History retrieved successfully!',
            'data' => $history,
        ]);
    }

    public function destroy($id)
    {
        $history = History::findOrFail($id);
        $history->delete();

        return response()->json([
            'success' => true,
            'message' => 'History deleted successfully!',
            'data' => $history,
        ]);
    }
}
