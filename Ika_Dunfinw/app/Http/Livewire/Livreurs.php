<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Livreur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Livreurs extends Component
{
    public $livreurs, $idRes, $prenom, $nom, $numtel, $adresse, $email, $password,$idLiv;
    public $isOpen = 0;
    public function render()
    {
        $idRes = Auth::user()->idRes;
        $this->livreurs = Livreur::where('idRes',$idRes)->get();
        return view('livewire.livreurs');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->prenom = '';
        $this->nom = '';
        $this->numtel = '';
        $this->adresse = '';
        $this->email = '';
        $this->password = '';
        $this->idLiv = '';
    }

    public function store()
    {
        $this->validate([
            'prenom' => 'required',
            'nom' => 'required',
            'numtel' => 'required',
            'adresse' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $idRes = Auth::user()->idRes;
        Livreur::Create([
            'idRes'=> $idRes,
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'numtel' => $this->numtel,
            'adresse' => $this->adresse,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
  
        session()->flash('message', 
            $this->idLiv ? 'User Updated Successfully.' : 'User Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $livreur = Livreur::findOrFail($id);
        $this->idLiv = $id;
        $this->prenom = $livreur->prenom;
        $this->nom = $livreur->nom;
        $this->numtel = $livreur->numtel;
        $this->adresse = $livreur->adresse;
        $this->email = $livreur->email;
        $this->password = $livreur->password;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Livreur::find($id)->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }
}
