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

        $this->authorize('view', ItemCategory::class);

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
            alert()->success('','Category Created Successfully !')->persistent('OK');
            return redirect()->back()->with('next_id');
        }


    }

    public function edit($id){

        $item_category = ItemCategory::find($id);
        return $item_category;

    }

    public function update(ItemCategoryRequest $request){
        $this->authorize('update', ItemCategory::class);
        
        $validated_data =  $request->validated();

        $category = DB::table('item_categories')->where('id', $validated_data['category_id'])->get()->toArray();
        // dd($category);
        if($category[0]->category_status === $validated_data['category_status'] && $category[0]->category_description ===  $validated_data['category_description']){
            $next_id = DB::table('item_categories')->max('id');
            alert()->error('',"You didn't change any value !")->persistent('OK');
            return redirect()->back()->with('next_id');
        }
        else
        {
            $query = DB::table('item_categories')->where('id', $validated_data['category_id'])->update([
                'category_status'=>$validated_data['category_status'],
                'category_description'=>$validated_data['category_description']
            ]);
    
            if($query){
                $next_id = DB::table('item_categories')->max('id');
                alert()->success('','Category Updated Successfully !')->persistent('OK');
                return redirect()->back()->with('next_id');
            }
        }

      

    }

    public function destroy($id){

        
        $this->authorize('delete', ItemCategory::class);

        $item_category = ItemCategory::where('id',$id)->delete();
        if($item_category != ""){
            $next_id = DB::table('item_categories')->max('id');
            alert()->success('','Category Deleted Successfully !')->persistent('OK');
            return redirect()->back()->with('next_id');
            

        }
    }
}
