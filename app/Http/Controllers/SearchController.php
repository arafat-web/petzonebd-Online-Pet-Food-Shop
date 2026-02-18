<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Search products by name, brand, or description
     * API endpoint: /api/search?q=query
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json(['products' => []]);
        }

        // Search in products table
        $products = Product::where(function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('brand', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        })
        ->with('category')
        ->limit(8)
        ->get()
        ->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'category_slug' => $product->category->slug,
                'category_name' => $product->category->name,
                'image' => $product->image,
                'price' => $product->price,
                'discount_price' => $product->discount_price,
                'display_price' => $product->getDisplayPrice(),
                'has_discount' => $product->hasDiscount(),
                'url' => route('product', [$product->category, $product]),
            ];
        });

        return response()->json([
            'products' => $products,
            'total' => count($products),
        ]);
    }
}
