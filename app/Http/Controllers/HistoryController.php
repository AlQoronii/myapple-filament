<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return response()->json(History::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'scan_date' => 'required|date',
            'scan_image_path' => 'required|string',
            'disease_info_id' => 'required|exists:categories,id',
        ]);

        $history = History::create($request->all());

        return response()->json($history, 201);
    }

    public function show($id)
    {
        $history = History::findOrFail($id);

        return response()->json($history);
    }

    public function destroy($id)
    {
        $history = History::findOrFail($id);
        $history->delete();

        return response()->json(['message' => 'History deleted successfully']);
    }
}
