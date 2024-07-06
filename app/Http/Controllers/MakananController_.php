<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    function index() {
        $data = Food::paginate(2);
        // dd($data);
        return view('food.index')->with('data',$data);
    }

    function detail($id){
        return "<h1>Ini makanan dengan $id</h1>";
    }
}
