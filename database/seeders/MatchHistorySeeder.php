<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MatchHistory;

class MatchHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    MatchHistory::create([
        'kecepatan' => 3.7,
        'ketepatan' => 95.0,
        'benar' => 18,
        'salah' => 2,
        'level' => 'menengah',
        'jumlah_soal' => 20,
    ]);
}
}
