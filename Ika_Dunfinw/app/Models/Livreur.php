<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Restaurant;
use App\Commande;

class Livreur extends Model
{
    use HasFactory;

    protected $fillable = [
        'idRes',
        'prenom',
        'nom',
        'numtel',
        'adresse',
        'email',
        'password',
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function commandes(){
        return $this->hasMany(Commande::class);
    }
}
