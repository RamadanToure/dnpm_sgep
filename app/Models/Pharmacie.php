<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_pharmacie',
        'repere_facile',
        'latitude',
        'longitude',
        'altitude',
        'titulaire_pharmacie',
        'telephone_titulaire',
        'email_pharmacie',
    ];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
