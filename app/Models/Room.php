<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_id', 
        'opponent_id', 
        'code', 
        'status', 
        'level'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function opponent()
    {
        return $this->belongsTo(User::class, 'opponent_id');
    }
}
