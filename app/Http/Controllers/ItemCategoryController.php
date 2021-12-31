<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCategoryRequest;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemCategoryController extends Controller
{
    //
    public function index(){

        // $this->authorize('view', ItemCategory::class);

        $next_id = DB::table('item_categories')->max('id');
        if($next_id == NULL){
            $next_id = 1;
        }
        $categories =  ItemCategory::all();
        return view('user.add-item-category', compact('categories'))->with('next_id',$next_id);
    }

    public function create(ItemCategoryRequest $request){

        $this->authorize('create', ItemCategory::class);
        
        $query = ItemCategory::create($request->validated());

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
        // $this->authorize('update', ItemCategory::class);
        dd($request);
        // $item_category = ItemCategory::update('id',$request->edit_category_id)->update([
        //     'category_description' => $request->edit_category_description,
        //     'category_code' => $request->edit_category_code,
        //     'category_status' => $request->edit_category_status
        // ]);


        // if($item_category != ""){
        //     $next_id = DB::table('item_categories')->max('id');
        //     return redirect()->back()->with('next_id');
        // }
    }

    public function delete($id){

        $this->authorize('delete', ItemCategory::class);

        $item_category = ItemCategory::where('id',$id)->delete();
        if($item_category != ""){
            $next_id = DB::table('item_categories')->max('id');
            return redirect()->back()->with('next_id');
            

        }
    }
}
