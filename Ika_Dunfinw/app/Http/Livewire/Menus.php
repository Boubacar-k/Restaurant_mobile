<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class Menus extends Component
{
    public $menus, $nom, $prix, $url, $menu_id;
    public $isOpen = 0;
    public function render()
    {
        $id = Auth::user()->idRes;
        $this->menus = Menu::where('idRes',$id)->get();
        return view('livewire.menus');
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
        $this->nom = '';
        $this->prix = '';
        $this->url = '';
        $this->menu_id = '';
    }

    public function store()
    {
        $this->validate([
            'nom' => 'required',
            'prix' => 'required',
            'url' => 'required',
        ]);
   
        Menu::updateOrCreate(['id' => $this->menu_id], [
            'nom' => $this->nom,
            'prix' => $this->prix,
            'url' => $this->url,
        ]);
  
        session()->flash('message', 
            $this->menu_id ? 'Menu Updated Successfully.' : 'Menu Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $this->menu_id = $id;
        $this->nom = $menu->nom;
        $this->prix = $menu->prix;
        $this->url = $menu->url;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Menu::find($id)->delete();
        session()->flash('message', 'Menu Deleted Successfully.');
    }
}
