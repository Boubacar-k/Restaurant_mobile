<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function menus(Request $request,$id)
    {

        $list =Menu::where('idRes',$id)->get();
        return $list;
    }

    public function selectMenus(Request $request,$id,$url)
    {

        $liste =Menu::where('idRes',$id)->where('url',$url)->get();
        return $liste;
    }
}