<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Users extends Component
{
    public $users, $idRes, $name, $telephone, $adresse, $email, $password, $idUser;
    public $isOpen = 0;
    public function render()
    {
        $idRes = Auth::user()->idRes;
        $this->users = User::where('idRes',$idRes)->where('type','0')->get();
        return view('livewire.users');
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
        $this->name = '';
        $this->telephone = '';
        $this->adresse = '';
        $this->email = '';
        $this->password = '';
        $this->idUser = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'telephone' => 'required',
            'adresse' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $idRes = Auth::user()->idRes;
        User::updateOrCreate(['id' => $this->idUser], [
            'idRes'=> $idRes,
            'name' => $this->name,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
  
        session()->flash('message', 
            $this->idUser ? 'User Updated Successfully.' : 'User Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function creer()
    {
        $this->validate([
            'name' => 'required',
            'telephone' => 'required',
            'adresse' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $idRes = Auth::user()->idRes;
        User::Create([
            'idRes'=> $idRes,
            'name' => $this->name,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
  
        session()->flash('message', 
            $this->idUser ? 'User Updated Successfully.' : 'User Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->idUser = $id;
        $this->name = $user->name;
        $this->telephone = $user->telephone;
        $this->adresse = $user->adresse;
        $this->email = $user->email;
        $this->password = $user->password;
        
    
        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User Deleted Successfully.');
    }
}
