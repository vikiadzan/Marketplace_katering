<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    function index(){
        return view("sesi.index");
    }

    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'

        ],[
            'email.required' => 'Wajib diisi',
            'password.rewuired' => 'Wajib Diisi',
        ]
        );

        $infologin =
    }
}
