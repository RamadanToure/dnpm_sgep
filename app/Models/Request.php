<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'prenoms',
        'contact',
        'email',
        'request_type_id',
        'etablissement_type_id',
        'status',
        'etape',
        'ref_op',
        'ref_diplome',
        'region_id',
        'prefecture_id',
        'sous_prefecture',
        'district',
        'quartier',
        'site',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Relation avec le type de demande
    public function requestType()
    {
        return $this->belongsTo(RequestType::class, 'request_type_id');
    }

    // Relation avec le type d'établissement
    public function etablissementType()
    {
        return $this->belongsTo(EtablissementType::class, 'etablissement_type_id');
    }

    // Relation avec la région
    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

    // Relation avec la préfecture
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class, 'prefecture_id');
    }



}
