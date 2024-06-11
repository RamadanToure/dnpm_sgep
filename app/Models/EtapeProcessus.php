<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapeProcessus extends Model
{
    use HasFactory;
    protected $table = 'etape_processus';

    protected $fillable = [
        'request_id',
        'etape',
        'statut',
        'date_debut',
        'date_fin',
        'remarques'
    ];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }

}
