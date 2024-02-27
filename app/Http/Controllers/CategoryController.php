<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use Session;
use App\Models\Category;

class CategoryController extends Controller {

    public function index(Request $request) {
        $categoryData = Category::where('created_by',Auth::id())->get();
        return view('categories.index', compact('categoryData'));
    }

    public function create(Request $request) {
        $parentCategoryData = Category::where('created_by',Auth::id())->get();
        return view('categories.create',compact('parentCategoryData'));
    }

    public function store(Request $request)
    {
        $validateArray =  array(
                        'name' => 'required',
                        'parent_id' => 'integer',
                      );
        
        $validator = Validator::make($request->all(),$validateArray);

        if ($validator->fails()) {
            return Redirect::to('categories/create')
                                ->withErrors($validator)
                                ->withInput();
        }

        if($request->parent_id != 0){
            $categoryData = Category::where('id',$request->parent_id)->first();
            $category_level = $categoryData->category_level + 1;
        }else{
            $category_level = 1;
        }

        $category = new Category();
        $category->created_by = Auth::id();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id ?? 0;
        $category->category_level = $category_level;
        $category->save();
        Session::flash('flash_message_success', 'Category created successfully!!');
        return Redirect::to('categories');
    }

    public function edit(Request $request,$id) {
        $categoryData = Category::where('id',$id)->first();
        $parentCategoryData = Category::where('created_by',Auth::id())->where('id',"!=",$id)->get();
        return view('categories.edit',compact('categoryData','parentCategoryData'));
    }

    public function update(Request $request,$id)
    {
        $validateArray =  array(
                        'name' => 'required',
                        'parent_id' => 'integer',
                      );
        
        $validator = Validator::make($request->all(),$validateArray);

        if ($validator->fails()) {
            return Redirect::to('categories/edit/'.$id)
                                ->withErrors($validator)
                                ->withInput();
        }

        if($request->parent_id != 0){
            $categoryData = Category::where('id',$request->parent_id)->first();
            $category_level = $categoryData->category_level + 1;
        }else{
            $category_level = 1;
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id ?? 0;
        $category->category_level = $category_level;
        $category->save();
        Session::flash('flash_message_success', 'Category updated successfully!!');
        return Redirect::to('categories');
    }
    
    public function destroy(Request $request,$id)
    {
    	$category = Category::find($id);
    	$category->delete();
        Session::flash('flash_message_success', 'Category deleted successfully!!');
    }

    public function getSubCategories(Request $request)
    {
        $parent_cat_ids_array = $request->parent_cat_ids;

        $categories_array = array();
        $i = 0;
        foreach ($parent_cat_ids_array as $value) {
            $categories = Category::where('parent_id',$value)->get()->toArray();
            if(count($categories) > 0){
                foreach ($categories as $k => $v) {
                    $categories_array[$i]['id'] = $v['id'];
                    $categories_array[$i]['name'] = $v['name'];
                    $i++;
                }
            }
        }
        return response()->json(['categories_array' => $categories_array]);
    }
}
