<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Client;
use App\User;
use App\Restaurant;
use App\Menu;
use App\Livraison;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = ['idClient','idRes','idMenu','nom','url','nombre','prixU','prix','payement','adresse'];
    protected $primaryKey = 'id';

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function livraisons(){
        return $this->hasMany(Livraison::class);
    }

}