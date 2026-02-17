<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ClientController extends Controller
{
    public function index()
    {

        return view('client.home.index', [
            'categories' => Category::all(),
            'catfoods' => Product::with('category')->where('cat_id', 1)
                ->orderby('id', 'desc')->take(4)->get(),
            'dogfoods' => Product::with('category')->where('cat_id', 2)
                ->orderby('id', 'desc')->take(4)->get(),
            'birdfoods' => Product::with('category')->where('cat_id', 3)
                ->orderby('id', 'desc')->take(4)->get(),
            'rabbitfoods' => Product::with('category')->where('cat_id', 4)
                ->orderby('id', 'desc')->take(4)->get(),
        ]);
    }

    public function product(Category $category, Product $product)
    {
        return view('client.product.product', [
            'relatedfoods' => Product::with('category')->where('cat_id', $category->id)
                ->orderby('id', 'desc')->take(4)->get(),
            'products' => $product,
        ]);
    }

    public function allProduct(Category $category)
    {
        return view('client.products.products', [
            'allfoods' => Product::with('category')->where('cat_id', $category->id)
                ->orderby('id', 'desc')->get(),
            'cat_name' => $category
        ]);
    }
}
