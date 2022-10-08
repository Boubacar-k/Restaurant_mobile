<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Menu;
use App\Commande;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['nom','adresse','photo'];
    protected $primaryKey = 'id';

    public function users(){
        return this->hasMany(User::class);
    }

    public function livreurs(){
        return this->hasMany(Livreur::class);
    }

    public function menus(){
        return this->hasMany(Menu::class);
    }

    public function commandes(){
        return this->hasMany(Commande::class);
    }
}
