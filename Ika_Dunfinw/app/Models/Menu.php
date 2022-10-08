<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Commande;
use App\Restaurant;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['nom','prix','url'];
    protected $primaryKey = 'id';

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function commandes(){
        return $this->hasMany(Commande::class);
    }
}
