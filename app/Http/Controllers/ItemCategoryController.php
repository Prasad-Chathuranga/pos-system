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

        $this->validate($request, [
            'category_code' => 'required',
            'category_description' => 'required',
            'category_status' => 'required'
        ]);

        $item_category = new ItemCategory();
        $item_category->category_description = $request->category_description;
        $item_category->category_code = $request->category_code;
        $item_category->category_status= $request->category_status;

        $query = $item_category->save();

        

        if($query){
            $next_id = DB::table('item_categories')->max('id');
            return redirect()->back()->with('next_id');
        }


    }

    public function edit($id){

        $item_category = ItemCategory::find($id);
        return $item_category;

    }

    public function update(Request $request){
      

        $item_category = ItemCategory::where('id',$request->edit_category_id)->update([
            'category_description' => $request->edit_category_description,
            'category_code' => $request->edit_category_code,
            'category_status' => $request->edit_category_status
        ]);


        if($item_category != ""){
            $next_id = DB::table('item_categories')->max('id');
            return redirect()->back()->with('next_id');
        }
    }

    public function delete($id){
        $item_category = ItemCategory::where('id',$id)->delete();
        if($item_category != ""){
            $next_id = DB::table('item_categories')->max('id');
            return redirect()->back()->with('next_id');
            

        }
    }
}
