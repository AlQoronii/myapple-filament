<?php

namespace App\Http\Controllers;

use App\Models\Apple;
use Illuminate\Http\Request;

class AppleController extends Controller
{
    public function index()
    {
        return response()->json(Apple::paginate(10)); // Pagination
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_apel' => 'required|string|max:255',
        ]);

        $apple = Apple::create($validated);

        return response()->json(['message' => 'Apple created successfully', 'data' => $apple], 201);
    }

    public function show($id)
    {
        $apple = Apple::find($id);

        if (!$apple) {
            return response()->json(['message' => 'Apple not found'], 404);
        }

        return response()->json($apple);
    }

    public function update(Request $request, $id)
    {
        $apple = Apple::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'nama_apel' => 'sometimes|string|max:255',
        ]);

        $apple->update($validated);

        return response()->json(['message' => 'Apple updated successfully', 'data' => $apple]);
    }

    public function destroy($id)
    {
        $apple = Apple::findOrFail($id);
        $apple->delete();

        return response()->json(['message' => 'Apple deleted successfully', 'data' => $apple]);
    }
}
