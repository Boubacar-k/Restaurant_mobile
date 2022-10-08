<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Client;
use App\Restaurant;
use App\User;
use App\Commande;
use App\Livreur;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = ['idClient','idRes','idUser','idCmd','idLivreur','nom','nombre','adresse', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commande(){
        return $this->belongsTo(Commmande::class);
    }

    public function livreur(){
        return $this->belongsTo(Livreur::class);
    }
}