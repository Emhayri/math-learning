<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'waktu', 'mode', 'kecepatan', 'ketepatan', 'benar', 'salah', 'level', 'jumlah_soal'
    ];
}
