<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
        $this->product->cat_id = $request->category;
        $this->product->price = $request->price;
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
    public function deleteProduct($id){
        $this->product = Product::find($id);
        $this->product->delete();
        return back()->with('success', 'Product has been deleted successfully!');
    }
}
