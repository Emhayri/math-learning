<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchHistory;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua data pertandingan dari database
        $historyData = MatchHistory::all();

        // Kirim data ke tampilan
        return view('home', compact('historyData'));
    }
    public function tes()
    {

        // Kirim data ke tampilan
        return view('tes');
    }
}
