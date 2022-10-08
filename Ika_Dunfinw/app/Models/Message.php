<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Restaurant;
use App\Client;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['idClient','idRes','contenu', 'created_at', 'updated_at'];
    protected $primaryKey = 'id';

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
