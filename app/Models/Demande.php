<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_demande',
        'pharmacie_id',
        'agent_traitant_id',
        'etat',
        'statut_traitement',
    ];

    // Relation avec la pharmacie
    public function pharmacie()
    {
        return $this->belongsTo(Pharmacie::class);
    }

    // Relation avec l'agent traitant
    public function agentTraitant()
    {
        return $this->belongsTo(AgentTraitant::class);
    }

    public function document()
    {
        return $this->hasOne(Document::class);
    }

}
