<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentTraitant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        // Ajouter d'autres attributs au besoin
    ];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
