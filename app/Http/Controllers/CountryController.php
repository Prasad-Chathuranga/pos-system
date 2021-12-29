<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    //
    public function index(){
        $next_id = DB::table('countries')->max('id');
        if($next_id == NULL){
            $next_id = 1;
        }
        $countries =  Country::all();
        return view('user.country', compact('countries'))->with('next_id',$next_id);
    }

    public function save(Request $request){
        $this->validate($request,[
            'country_code' => 'required',
            'country_name' => 'required'
        ]);

        $country =  new Country();
        $country->country_code = $request->country_code;
        $country->country_name = $request->country_name;
        $query = $country->save();

        

        if($query){
            $next_id = DB::table('countries')->max('id');
            return redirect()->back()->with('next_id');
        }


    }

    public function edit($id){
        $country = Country::find($id);
        return $country;
    }

    public function delete($id){
        $country =  Country::where('id', $id)->delete();
        if($country != ""){
            $next_id = DB::table('countries')->max('id');
            return redirect()->back()->with('next_id');
        }
    }

    public function update(Request $request){

        $country = DB::table('countries')
        ->where('id',$request->edit_country_id)
        ->update([
            'country_code' => $request->edit_country_code,
            'country_name' => $request->edit_country_name
        ]);

        if($country != ""){
            $next_id = DB::table('countries')->max('id');
            return redirect()->back()->with('next_id');
        }
    }
    
}
