<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Auth;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index(Request $request){
        return Auth::user();
    }

    public function register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:clients',
            'telephone'=>'required|unique:clients|max:13',
            'password'=>'required|confirmed',
        ]);

        $result = Client::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'telephone'=>$request->telephone,
            'password'=>bcrypt($request->password),
        ]);

        return $result;
        event(new Registered($result));
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::guard('client')->attempt($credentials)){
            $client = Auth::guard('client')->user();
            $token = md5( time() ).'.'.md5($request->email);
            $client->forceFill([
                'api_token'=>$token,
            ])->save();
            return response()->json([
                'token'=>$token
            ]); 
        }

        return response()->json([
            'message'=>'Veuillez verifier votre email ou votre mot de passe.'
        ],401);
    }

    public function logout(Request $request){
        $request->user()->forceFill([
            'api_token'=>null,
        ])->save();

        return response()->json(['message'=>'success']);
    }

    public function photoUser(Request $request){
        $client = Client::find(Auth::user()->id);

        $photo = '';

        if($request->photo!=''){

            $photo = time().'.jpg';

            file_put_contents('C:\Users\PC\Ika_Dunfinw\storage\app/public/profiles/'.$photo,base64_decode($request->photo));
            $client->photo = $photo;
        }

        $client->update();

        return response()->json([
            'success'=> true,
            'photo'=> $photo
        ]);
    }
}
