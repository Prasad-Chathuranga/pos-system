<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReOrderRequest;
use App\Models\items;
use App\Models\ReOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reorder_items = DB::table('items')->whereColumn('reorder_level','=','soh')->get();

        return view('user.reorder',compact('reorder_items'));
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

    public function allReOrders(){
        $reorder_items = ReOrder::orderBy('id', 'DESC')->get();

        return view('user.re-ordered-items',compact('reorder_items'));
    }

    public function updateSoh(ReOrderRequest $request){
        if($request->ajax()){

            // dd($request);

            $query = DB::table('items')->where('id', $request->item_id)->update([
                'soh'=>$request->new_soh
            ]);

            $query2 = ReOrder::create($request->validated());
            // ReOrder::creat

            // dd($query);

        
            return response()->json(['url'=>url('user/re-order')]);
            


        }
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
    }
}
