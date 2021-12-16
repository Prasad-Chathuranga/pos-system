<?php

namespace App\Http\Controllers;

use App\Models\items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    //

    public function index(){
        return view('user.invoice');
    }

    public function search(Request $request){
        if($request->ajax()){
            $data = items::where('item_no','LIKE',$request->result . '%')->get();
            $output = '';
  
            if (count($data)>0) {
                
              $output = '<div class="col-md-12" style="overflow-y: scroll; height: 150px">
              <table id="searchTable" class="table">
                <tbody>';
  
              foreach ($data as $row){
                
                  $output .= '<tr style="background: #f0ebdf; cursor: pointer" >';
                  $output .= '<td id='.$row->id.'><span class="float-left">'.$row->item_no.'</span></td>';
                  $output .= '</tr>';
  
              }
  
              $output .= '</tbody> </table> </div>';
              
          }
         
          return $output;
        }
      }

      public function itemDetails(Request $request){
        if($request->ajax()){
       
          $data = DB::table('items')->where('item_no',$request->data)->first();
          return $data;
            
        }
    }

}
