<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PetRecord;
use App\Models\User;

class Pet extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'birthday',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function records()
    {
        return $this->hasMany(PetRecord::class);
    }
}