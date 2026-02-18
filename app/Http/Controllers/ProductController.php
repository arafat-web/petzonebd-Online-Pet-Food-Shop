<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public $product, $image, $imageName, $directory, $imgURL;
    public function addProduct()
    {
        return view('admin.manage-products.add', [
            'categories' => Category::all()
        ]);
    }


    private function saveImage($request){
        $this->image = $request->file('image');
        $this->imageName = rand().'.'.$this->image->getClientOriginalExtension();
        $this->directory = 'images/';
        $this->imgURL = $this->directory.$this->imageName;
        $this->image->move($this->directory, $this->imageName);
        return $this->imgURL;
    }

    public function saveProduct(Request $request)
    {
        $this->product = new Product();
        $this->product->name = $request->name;
        $this->product->slug = Str::slug($request->name);
        $this->product->cat_id = $request->category;
        $this->product->price = $request->price;
        $this->product->discount_price = $request->discount_price ?? null;
        $this->product->brand = $request->brand;
        $this->product->description = $request->description;
        $this->product->image = $this->saveImage($request);
        $this->product->save();
        return back()->with('success', 'Product has been added successfully!');
    }

    public function manageProduct(){

        $this->product = DB::table('products')
            ->join('categories', 'products.cat_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as cat_name')
            ->get();
        return view('admin.manage-products.manage-products', [
            'products' => $this->product
        ]);
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return back()->with('error', 'Product not found!');
        }
        return view('admin.manage-products.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return back()->with('error', 'Product not found!');
        }

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->cat_id = $request->category;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price ?? null;
        $product->brand = $request->brand;
        $product->description = $request->description;

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $product->image = $this->saveImage($request);
        }

        $product->save();
        return back()->with('success', 'Product has been updated successfully!');
    }

    public function deleteProduct($id){
        $this->product = Product::find($id);
        if ($this->product) {
            // Delete image if exists
            if ($this->product->image && file_exists(public_path($this->product->image))) {
                unlink(public_path($this->product->image));
            }
            $this->product->delete();
        }
        return back()->with('success', 'Product has been deleted successfully!');
    }
}
