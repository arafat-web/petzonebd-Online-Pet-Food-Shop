<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public $category, $image, $imageName, $directory, $imgURL;

    public function manageCategory()
    {
        return view('admin.manage-category.manage-categories', [
            'categories' => Category::all()
        ]);
    }

    public function addCategory(Request $request)
    {
        Category::saveCategory($request);
        return back()->with('success', 'Category has been added successfully!');
    }

    public function deleteCategory($id)
    {
        $this->category = Category::find($id);
        if (File::exists($this->category->cat_image)) {
            unlink($this->category->cat_image);
        }
        $this->category->delete();
        return back()->with('success', 'Category has been deleted successfully!');
    }

    public function editCategory($id)
    {
        $this->category = Category::find($id);
        return view('admin.manage-category.manage-categories', [
            'edit' => 'true',
            'category' => $this->category,
            'categories' => Category::all()
        ]);
    }

    public function updateCategory(Request $request)
    {

        $this->category = Category::find($request->id);
        $this->category->name = $request->cat_name;
        $this->category->slug = $request->cat_slug;
        if ($request->hasFile('cat_img')) {
            if (File::exists($this->category->cat_image)) {
                unlink($this->category->cat_image);
            }
            $this->category->cat_image = $this->saveImage($request);
        } else {

        }
        $this->category->save();
        return back()->with('success', 'Category has been updated successfully!');
    }

    private function saveImage($request)
    {
        $this->image = $request->file('cat_img');
        $this->imageName = rand() . '.' . $this->image->getClientOriginalExtension();
        $this->directory = 'images/';
        $this->imgURL = $this->directory . $this->imageName;
        $this->image->move($this->directory, $this->imageName);
        return $this->imgURL;
    }
}
