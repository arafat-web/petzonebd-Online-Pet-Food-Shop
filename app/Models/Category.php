<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    private static $category, $image, $imageName, $directory, $imgURL;
    use HasFactory;

    public static function saveCategory($request){
        self::$category = new Category();
        self::$category->name = $request->cat_name;
        self::$category->slug = $request->cat_slug;
        self::$category->cat_image = self::saveImage($request);
        self::$category->save();
    }

    private static function saveImage($request){
        self::$image = $request->file('cat_img');
         self::$imageName = rand().'.'. self::$image->getClientOriginalExtension();
         self::$directory = 'images/';
         self::$imgURL =  self::$directory. self::$imageName;
         self::$image->move( self::$directory,  self::$imageName);
        return  self::$imgURL;
    }
}
