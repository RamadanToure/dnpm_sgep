<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['request_id', 'type_document', 'fichier', 'date_de_soumission'];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
