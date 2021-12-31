<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;
use Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $next_id = DB::table('customers')->max('id');
        if($next_id == NULL){
            $next_id = 1;
        }
        $customers =  Customer::all();
        return view('user.customer', compact('customers'))->with('next_id',$next_id);

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
        //
        // dd($request->all());

        $this->validate($request,[
            'customer_name'=>'required',
            'name_for_code'=>'required',
            'type'=>'required',
            'address_line_1'=>'required',
            'address_line_2'=>'required',
            'address_line_3'=>'required',
            'city'=>'required',
            'telephone_no'=>'required',
            'mobile_no'=>'required',
            'fax_no'=>'required',
            'email'=>'required',
            'about'=>'required',
            'credit_balance'=>'required'
            
        ]);

        $customer = new Customer();
        
        $customer->customer_name = $request->customer_name;
        $customer->name_for_code = $request->name_for_code;
        $customer->type = $request->type;
        $customer->address_line_1 = $request->address_line_1;
        $customer->address_line_2 = $request->address_line_2;
        $customer->address_line_3 = $request->address_line_3;
        $customer->city = $request->city;
        $customer->telephone_no = $request->telephone_no;
        $customer->mobile_no = $request->mobile_no;
        $customer->fax_no = $request->fax_no;
        $customer->email = $request->email;
        $customer->about = $request->about;
        $customer->credit_balance = $request->credit_balance;

       $query = $customer->save();
        if($query){  

            alert()->success('','Customer Saved Successfully !')->persistent('OK');
            return redirect()->back();

        }
        

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

        $customer = Customer::where('id',$id)->delete();
        if($customer != ""){
          
            return redirect()->back();
            

        }


    }

    public function search(Request $request){
        
        $founded_customers = Customer::latest()
        ->where('customer_name', 'like', $request->result.'%')
        ->count();

        return $founded_customers;



    }

    
}
