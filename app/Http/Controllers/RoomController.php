<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
{
    private $rooms = [];

    // Fungsi untuk membuat room dan memberi kode
    public function createRoom(Request $request)
    {
        $code = $this->generateRoomCode();
        $creator = $request->input('creator');

        // Simpan kode room dan creator dalam session
        Session::put("room_$code", [
            'code' => $code,
            'creator' => $creator,
            'participants' => [$creator]  // Tambahkan creator ke dalam daftar peserta
        ]);

        return response()->json(['code' => $code]);
    }

    // Fungsi untuk bergabung dengan room
    public function joinRoom(Request $request)
    {
        $code = $request->input('code');
        $participant = $request->input('participant');

        if (Session::has("room_$code")) {
            $room = Session::get("room_$code");

            // Tambahkan peserta ke room
            $room['participants'][] = $participant;
            Session::put("room_$code", $room);

            return response()->json(['status' => 'success', 'participants' => $room['participants']]);
        }

        return response()->json(['status' => 'error', 'message' => 'Room not found'], 404);
    }

    // Fungsi untuk mendapatkan peserta di dalam room
    public function getParticipants($code)
    {
        if (Session::has("room_$code")) {
            $room = Session::get("room_$code");
            return response()->json(['participants' => $room['participants']]);
        }

        return response()->json(['status' => 'error', 'message' => 'Room not found'], 404);
    }

    // Fungsi untuk mengenerate kode room
    private function generateRoomCode()
    {
        return strtoupper(substr(md5(time() . rand()), 0, 6));
    }
}
