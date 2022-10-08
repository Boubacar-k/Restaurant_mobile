<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Commande;
use App\Models\Livraison;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class Commandes extends Component
{
    public $commandes, $idClient, $idRes, $idMenu, $nom, $url, $nombre, $prixU, $prix, $payement,$adresse;
    public function render()
    {
        $idRes = Auth::user()->idRes;
        $this->commandes = Commande::join('clients','commandes.idClient','=','clients.id')->where('idRes',$idRes)->where('payement',null)->get(['commandes.*','clients.name']);
        return view('livewire.commandes');
    }

    public function edit($id)
    {
        $idU = Auth::user()->id;
        $idRes = Auth::user()->idRes;
        Commande::find($id)->update([
            'payement' => 'payé'
         ]);
        session()->flash('message', 'Valid Successfully.');

        $cmd = Commande::find($id);
        Livraison::insert(['idClient'=>$cmd->idClient, 'idRes'=> $idRes, 'idUser'=> $idU,'idCmd' => $id, 'nom'=> $cmd->nom, 'nombre'=>$cmd->nombre,'adresse'=>$cmd->adresse,'created_at' => Now(), 'updated_at' => Now() ]);
        Message::insert(['idRes'=> $idRes, 'idClient'=>$cmd->idClient, 'contenu'=> 'votre achat a été validé vous serez bientôt livré', 'created_at' => Now(), 'updated_at' => Now() ]);
    }
}
