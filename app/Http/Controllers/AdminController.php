<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getUsers(){
        return view('users', [
            'users' => \App\User::all(),
        ]);
    }
    
}
