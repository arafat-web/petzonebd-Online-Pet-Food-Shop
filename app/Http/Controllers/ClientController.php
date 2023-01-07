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
            'catfoods' => Product::where('cat_id', 1)
                ->orderby('id', 'desc')->take(4)->get(),
            'dogfoods' => Product::where('cat_id', 2)
                ->orderby('id', 'desc')->take(4)->get(),
            'birdfoods' => Product::where('cat_id', 3)
                ->orderby('id', 'desc')->take(4)->get(),
            'rabbitfoods' => Product::where('cat_id', 4)
                ->orderby('id', 'desc')->take(4)->get(),
            ''
        ]);
    }

    public function product($cat_id, $id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as cat_name')
            ->where('products.id', $id)
            ->first();
        return view('client.product.product', [
            'relatedfoods' => Product::where('cat_id', $cat_id)
                ->orderby('id', 'desc')->take(4)->get(),
            'products' => $product,

        ]);
    }

    public function allProduct($id)
    {
        return view('client.products.products', [
            'allfoods' => Product::where('cat_id', $id)
                ->orderby('id', 'desc')->get(),
            'cat_name' => Category::where('id', $id)
            ->first()
        ]);
    }
}
