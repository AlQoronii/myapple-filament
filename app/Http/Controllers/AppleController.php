<?php

namespace App\Http\Controllers;

use App\Models\Apple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppleController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id', // Validasi user_id
        ]);
    
        $apples = Apple::where('user_id', $validated['user_id'])->paginate(10); // Filter berdasarkan user_id
    
        return response()->json($apples);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_apel' => 'required|string|max:255',
            'image_path' => 'required|file|mimes:jpeg,jpg,png|max:10240', // Ubah dari image_path ke image
        ]);

         // Simpan file dan dapatkan nama file
    $file = $request->file('image_path');
    $fileName = $file->getClientOriginalName(); // Ambil nama file asli
    $filePath = $file->storeAs('images/apples', $fileName, 'public'); // Simpan dengan nama asli

    // Tambahkan nama file ke data yang akan disimpan
    $appleData = $validated;
    $appleData['image_path'] = $fileName; // Simpan hanya nama file

    $apple = Apple::create($appleData);

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
            'image_path' => 'sometimes|file|mimes:jpeg,jpg,png|max:10240', // Tambahkan untuk image optional
        ]);

        if ($request->hasFile('image_path')) {
            // Hapus file lama jika ada
            if ($apple->image_path && Storage::disk('public')->exists($apple->image_path)) {
                Storage::disk('public')->delete($apple->image_path);
            }

            // Simpan file baru
            $filePath = $request->file('image_path')->store('images/apples', 'public');
            $validated['image_path'] = $filePath;
        }

        $apple->update($validated);

        return response()->json(['message' => 'Apple updated successfully', 'data' => $apple]);
    }

    public function destroy($id)
    {
        $apple = Apple::findOrFail($id);

        // Hapus file terkait jika ada
        if ($apple->image_path && Storage::disk('public')->exists($apple->image_path)) {
            Storage::disk('public')->delete($apple->image_path);
        }

        $apple->delete();

        return response()->json(['message' => 'Apple deleted successfully', 'data' => $apple]);
    }
}
