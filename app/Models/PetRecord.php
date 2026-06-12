<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pet;

class PetRecord extends Model
{
    protected $fillable = [
        'pet_id',
        'record_type',
        'memo',
        'recorded_at',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
