<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    public function redirect(){
        if(Auth::id()){
            if(Auth::user()->type == '0'){
                return view('dashboard');
            }
            else{
                return view('admin.home');
            }
        }
        else{
            return redirect()->back();
        }
    }
}
