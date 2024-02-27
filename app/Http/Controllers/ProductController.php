<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect;
use Session;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller {

    public function index(Request $request) {
        $productData = Product::where('created_by',Auth::id())->get();
        foreach ($productData as $key => $value) {
            $catIds = explode(',', $value->category_ids);
            $catNames = Category::whereIn('id',$catIds)->pluck('name')->toArray();
            $value->category_ids = implode(',', $catNames);
        }
        return view('products.index', compact('productData'));
    }

    public function create(Request $request) {
        $parentCategoryData = Category::where('parent_id',0)->where('created_by',Auth::id())->get();
        return view('products.create',compact('parentCategoryData'));
    }

    public function store(Request $request)
    {
        $validateArray =  array(
                        'name' => 'required',
                        'description' => 'required',
                        'price' => 'required',
                        'quantity' => 'required|integer',
                        'category_ids' => 'required',
                      );

        $validator = Validator::make($request->all(),$validateArray);

        if ($validator->fails()) {
            return Redirect::to('products/create')
                                ->withErrors($validator)
                                ->withInput();
        }

        $product = new Product();
        $product->created_by = Auth::id();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_ids = $request->category_ids;
        $product->category_level = $request->category_level;
        $product->save();
        Session::flash('flash_message_success', 'Product created successfully!!');
        return Redirect::to('products');
    }

    public function edit(Request $request,$id) {
        $productData = Product::where('id',$id)->first();
        $catIds = explode(',', $productData->category_ids);
        $productData->category_ids = $catIds;
        $categoryArray = array();
        for($i=1 ; $i<=$productData->category_level; $i++){
            $parentCategoryData = Category::where('category_level',$i)->where('created_by',Auth::id())->get();
            $categoryArray[$i] = $parentCategoryData;
        }

        return view('products.edit',compact('productData','categoryArray'));
    }

    public function update(Request $request,$id)
    {
        $validateArray =  array(
                        'name' => 'required',
                        'description' => 'required',
                        'price' => 'required',
                        'quantity' => 'required|integer',
                        'category_ids' => 'required',
                      );
        
        $validator = Validator::make($request->all(),$validateArray);

        if ($validator->fails()) {
            return Redirect::to('products/edit/'.$id)
                                ->withErrors($validator)
                                ->withInput();
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_ids = $request->category_ids;
        $product->category_level = $request->category_level;
        $product->save();
        Session::flash('flash_message_success', 'Product updated successfully!!');
        return Redirect::to('products');
    }
    
    public function destroy(Request $request,$id)
    {
    	$product = Product::find($id);
    	$product->delete();
        Session::flash('flash_message_success', 'Product deleted successfully!!');
    }
}
