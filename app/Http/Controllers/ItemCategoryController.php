<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemCategoryController extends Controller
{
    //
    public function index(){
        $next_id = DB::table('item_categories')->max('id');
        if($next_id == NULL){
            $next_id = 1;
        }
        $categories =  ItemCategory::all();
        return view('user.add-item-category', compact('categories'))->with('next_id',$next_id);
    }

    public function save(Request $request){

        // dd($request->all());

        // $input = $request->all();
        $this->validate($request, [
            'category_code' => 'required',
            'category_description' => 'required',
            'category_status' => 'required'
        ]);

        $item_category = new ItemCategory();
        $item_category->category_description = $request->category_description;
        $item_category->category_code = sprintf("%04s", $request->category_code);
        $item_category->category_status= $request->category_status;

        $query = $item_category->save();

        

        if($query){
            $next_id = DB::table('item_categories')->max('id');
            return redirect()->back()->with('next_id');
        }


    }
}
