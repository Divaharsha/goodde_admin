<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\CategoryLogic;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get_categories()
    {
        try {
            $categories = Category::where(['position'=>0,'status'=>1])->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_childes($id)
    {
        try {
            $categories = Category::where(['parent_id' => $id,'status'=>1])->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products($id, Request $request)
    {
        $product_type = $request['product_type'];
        return response()->json(Helpers::product_data_formatting(CategoryLogic::products($id, $product_type), true), 200);
    }

    public function get_all_products($id)
    {
        try {
            return response()->json(Helpers::product_data_formatting(CategoryLogic::all_products($id), true), 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }
    public function CreateCategory(Request $request) {

        //image upload
       //  if (!empty($request->file('image'))) {
       //     $image_name = Helpers::upload('category/', 'png', $request->file('image'));
       // } else {
       //     $image_name = 'def.png';
       // }
       // if (!empty($request->file('banner_image'))) {
       //     $banner_image_name = Helpers::upload('category/banner/', 'png', $request->file('banner_image'));
       // } else {
       //     $banner_image_name = 'def.png';
       // }

       
       $category = new Category;
       $category->name = $request->name;
       $category->image = $image_name;
       $category->banner_image = $banner_image_name;
       $category->save();
   
       return response()->json([
           "message" => "Category created Successfully"
       ], 201);
     }
}
