<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ItemCategory;

use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    //
    public function index(){
        $items = DB::table('items')->get();
        return view('user.add-item', compact('items'));
    }

    public function search(Request $request){
      if($request->ajax()){
          $data = ItemCategory::where('category_description','LIKE',$request->result . '%')->get();
          $output = '';

          if (count($data)>0) {
              
            $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
          
            foreach ($data as $row){
            
                $output .= '<li class="list-group-item">'.$row->category_description.'</li>';
            }
          
            $output .= '</ul>';
        }
        else {
         
            $output .= '<li class="list-group-item">'.'No results'.'</li>';
        }
       
        return $output;
      }
    }
}
