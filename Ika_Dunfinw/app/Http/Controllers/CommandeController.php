<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Client;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function commande(Request $request)
    {
        $result = Commande::create([
            'idClient' => Auth::user()->id,
            'idRes' => $request->idRes,
            'idMenu' => $request->idMenu,
            'nom' => $request->nom,
            'url' => $request->url,
            'nombre' => $request->nombre,
            'prixU' => $request->prixU,
            'prix' => $request->prix
        ]);
        return $result;
    }

    public function afficher(Request $request,$idRes)
    {
        $id = Auth::user()->id;

        $list =Commande::where('idClient',$id)->where('idRes',$idRes)->where('payement',null)->where('adresse',null)->get();
        return $list;
    }

    public function affichage(Request $request)
    {
        $id = Auth::user()->id;

        $liste =Commande::where('idClient',$id)->where('payement','payé')->get();
        
        return $liste;
    }

    public function adresse(Request $request)
    {
        $id = Auth::user()->id;

        Commande::where('idClient',$id)->where('payement',null)->update([
            'adresse' => $request->adresse
         ]);
    }
}


