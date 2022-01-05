<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use App\Models\items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = DB::table('items')->get();
        $countries = DB::table('countries')->get();
        return view('admin.add-item', compact('items','countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd($id);

        if(Auth::user()->role == 1){
            $item = items::where('id',$id)->delete();
        if($item != ""){
            
            return response()->json(['url'=>url('admin/add-item')]);
            

        }
        }else{
           abort(403);
        }
        
    
    }
}
