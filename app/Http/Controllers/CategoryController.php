<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10); // Pagination
        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'treatment' => 'required|string|max:1000',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully!',
            'data' => $category,
        ], 201);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Category retrieved successfully!',
            'data' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'category' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:1000',
            'treatment' => 'sometimes|string|max:1000',
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully!',
            'data' => $category,
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully!',
            'data' => $category,
        ]);
    }

    public function getCategoryByLabel($category)
    {
        try {
            // Ambil semua kategori yang sesuai dengan nama category
            $categories = Category::where('category', $category)->get();
    
            // Jika tidak ada kategori yang ditemukan
            if ($categories->isEmpty()) {
                throw new \Exception('No categories found for the given label');
            }
    
            // Kembalikan hasil dalam bentuk JSON
            return response()->json([
                'success' => true,
                'message' => 'Category retrieved successfully',
                'data' => $categories
            ]);
        } catch (\Exception $e) {
            // Menangkap exception dan mengembalikan pesan error asli
            return response()->json([
                'success' => false,
                'message' => 'Error occurred',
                'error' => $e->getMessage(),  // Menampilkan pesan error asli
                'trace' => $e->getTraceAsString()  // Opsional: Menampilkan stack trace jika diperlukan
            ], 500);  // Status code 500 untuk error internal server
        }
    }
    
    
    

}
