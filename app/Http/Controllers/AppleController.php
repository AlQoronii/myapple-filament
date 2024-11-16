<?php

namespace App\Http\Controllers;

use App\Models\Apple;
use Illuminate\Http\Request;

class AppleController extends Controller
{
    public function index()
    {
        return response()->json(Apple::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_apel' => 'required|string|max:255',
        ]);

        $apple = Apple::create($request->all());

        return response()->json($apple, 201);
    }

    public function show($id)
    {
        $apple = Apple::findOrFail($id);

        return response()->json($apple);
    }

    public function update(Request $request, $id)
    {
        $apple = Apple::findOrFail($id);
        $apple->update($request->all());

        return response()->json($apple);
    }

    public function destroy($id)
    {
        $apple = Apple::findOrFail($id);
        $apple->delete();

        return response()->json(['message' => 'Apple deleted successfully']);
    }
}
