<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Models\items;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    //
    public function index(){
        $items = DB::table('items')->get();
        $countries = DB::table('countries')->get();
        return view('user.add-item', compact('items','countries'));
    }

    public function getAllItems(){
        $items = DB::table('items')->get();
        return $items;
    }

    public function priceChange(){
        $items = items::paginate(100);
    //    foreach ($items as $key => $value) {
    //        dd($value);
    //    }
        return view('user.price-change', compact('items'));

    }

    public function search(Request $request){
      if($request->ajax()){
          $data = ItemCategory::where('category_description','LIKE',$request->result . '%')->get();
          $output = '';

          if (count($data)>0) {
              
            $output = '<div class="col-md-12" style="overflow-y: scroll; height: 150px">
            <table id="searchTable" class="table">
              <tbody>';

            foreach ($data as $row){
              
                $output .= '<tr style="background: #f0ebdf; cursor: pointer" >';
                $output .= '<td><span class="float-left">'.$row->category_description.'</span></td>';
                $output .= '</tr>';

            }

            $output .= '</tbody> </table> </div>';
            
        }
       
        return $output;
      }
    }

    public function searchEdit(Request $request){
        if($request->ajax()){
            $data = ItemCategory::where('category_description','LIKE',$request->result . '%')->get();
            $output = '';
  
            if (count($data)>0) {
                
              $output = '<div class="col-md-12" style="overflow-y: scroll; height: 150px">
              <table id="searchTableEdit" class="table">
                <tbody>';
  
              foreach ($data as $row){
                
                  $output .= '<tr style="background: #f0ebdf; cursor: pointer" >';
                  $output .= '<td id='.$row->id.'><span class="float-left">'.$row->category_description.'</span></td>';
                  $output .= '</tr>';
  
              }
  
              $output .= '</tbody> </table> </div>';
              
          }
         
          return $output;
        }
      }


    public function categoryDetials(Request $request){
        if($request->ajax()){
            $category_data = ItemCategory::where('category_description', $request->data)->get()->first();
            $count_items_from_selected_category = items::where('category_code', $category_data->category_code)->count();
            $next_item_id =  $category_data->id.'-'.sprintf("%03s",$count_items_from_selected_category+1);

            $data = array(
               'category_data' => $category_data,
               'next_item_id' =>  $next_item_id

            );

            return $data;
        }
    }

    public function edit($id){

        $item = items::find($id);
        return $item;

    }

    public function save(ItemRequest $request){

        // dd($request);

       
        $item = new items();
        $query = $item->save($request->validated());

        

        if($query){
            
            return redirect()->back();
        }
        

    }

    public function update(Request $request){
     
        $item = items::where('id',$request->edit_item_id)->update([
            'item_no' => $request->item_no,
            'item_code' => $request->item_code,
            'description'=> $request->item_description,
            'soh' => $request->soh,
            'bin' => $request->bin,
            'cost_price' => $request->cost_price,
            'status' => $request->status,
            'sale_price' => $request->sale_price,
            'reorder_level' => $request->reorder_level,
            'country'=> $request->country,
            'category_code' => $request->code,
            'category' => $request->description
        ]);


        if($item != ""){
            return redirect()->back();
        }
       

       
    }

    public function delete($id){
        // dd($id);
        if(Auth::user()->role == 1){
            $item = items::where('id',$id)->delete();
        if($item != ""){
            
            return response()->json(['url'=>url('user/add-item')]);
            

        }
        }else{
            return response()->json(['message'=>'You can not perform this action !']);
            // abort(401);
        }
        
    }


}
