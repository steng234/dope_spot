<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ClothingType;

class ProductController extends Controller
{
    public function productSelection(Request $request)
    {
        // Retrieve all products initially
        $products = Product::query();

        // Filter by brand if provided
        if ($request->filled('brand_id')) {
            $products->where('brand_id', $request->input('brand_id'));
        }

        // Filter by category if provided
        if ($request->filled('category_id')) {
            $products->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('type_id')) {
            $products->where('type_id', $request->input('type_id'));
        }

        // Get the filtered products
        $products = $products->get();


        $brandsQuery = Brand::query();
        $categoriesQuery = Category::query();
        $typesQuery = ClothingType::query();
        
        if ($request->filled('category_id')) {
            $categoriesQuery->where('id', '!=', $request->input('category_id'));
        }

        // Exclude the selected type if provided
        if ($request->filled('type_id')) {
            $typesQuery->where('id', '!=', $request->input('type_id'));
        }

        // Exclude the selected brand if provided
        if ($request->filled('brand_id')) {
            $brandsQuery->where('id', '!=', $request->input('brand_id'));
        }

        $categories = $categoriesQuery->get();
        $types = $typesQuery->get();
        $brands = $brandsQuery->get();

        
        $selectedCategory = $request->filled('category_id') ? Category::find($request->input('category_id')) : null;
        $selectedType = $request->filled('type_id') ? ClothingType::find($request->input('type_id')) : null;
        $selectedBrand = $request->filled('brand_id') ? Brand::find($request->input('brand_id')) : null;
    
        return view('product', compact('products', 'brands', 'categories', 'types', 'selectedCategory', 'selectedType','selectedBrand'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id); // Assuming you have the Product model
        
        return view('product-detail', compact('product'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $results = Product::where('products.name', 'like', '%' . $searchTerm . '%')
            ->orWhereHas('brand', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->orWhereHas('category', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->with('brand', 'category')
            ->get();

        // Organize search results into a matrix
        $matrix = [
            'brand' => [],
            'category' => [],
            'product' => []
        ];

        foreach ($results as $result) {
            $brand = $result->brand;
            $category = $result->category;

            // Add brand to the matrix if it's not already present
            if (!isset($matrix['brand'][$brand->id])) {
                $matrix['brand'][$brand->id] = $brand->name;
            }

            // Add category to the matrix if it's not already present
            if (!isset($matrix['category'][$category->id])) {
                $matrix['category'][$category->id] = $category->name
;
            }

            // Add product to the matrix
            $matrix['product'][] = $result;
        }

        // Convert matrix to JSON response
        return response(['result' => $matrix]);
    }
}
