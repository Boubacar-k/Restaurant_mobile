<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function message(Request $request)
    {
        $id = Auth::user()->id;

        $sms =  Message::join('restaurants','messages.idRes','=','restaurants.id')->where('idClient',$id)
        ->get(['messages.*','restaurants.nom','restaurants.photo']);
        return $sms;
    }
}
