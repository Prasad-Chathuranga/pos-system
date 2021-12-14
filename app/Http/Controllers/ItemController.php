<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    //
    public function index(){
        $items = DB::table('items')->get();
        return view('user.add-item', compact('items'));
    }
}
