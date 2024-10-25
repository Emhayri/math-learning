<?php

            // use Illuminate\Support\Facades\Route;
            // use App\Http\Controllers\RoomController;
            // use App\Http\Controllers\QuestionController;
            // use App\Http\Controllers\QuizController;
            // use Illuminate\Http\Request;

            // /*
            // |--------------------------------------------------------------------------
            // | Web Routes
            // |--------------------------------------------------------------------------
            // |
            // | Here is where you can register web routes for your application. These
            // | routes are loaded by the RouteServiceProvider and all of them will
            // | be assigned to the "web" middleware group. Make something great!
            // |
            // */

            // // Rute untuk halaman utama
            // Route::get('/', function () {
            //     return view('home');
            // });

            // Route::post('/room/create', [RoomController::class, 'createRoom'])->name('room.create');
            // Route::post('/room/join', [RoomController::class, 'joinRoom'])->name('room.join');
            // Route::get('/room/participants', [RoomController::class, 'getParticipants'])->name('room.participants');

            // // Rute untuk bertanding dengan komputer (POST)
            // Route::post('/room/computer', [RoomController::class, 'playAgainstComputer'])->name('room.computer');

            // // Rute untuk menampilkan daftar soal (misalnya) - Opsional
            // Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');

            // Route::post('/start-quiz', [QuizController::class, 'startQuiz'])->name('start.quiz');


            // Route::post('/submit-quiz', function (Request $request) {
            //     $answers = $request->input('answers');

            //     // Here you can check answers and calculate the score
            //     // For simplicity, we're just returning the answers for now.
            //     return response()->json(['answers' => $answers]);
            // });
            // Route::post('/submit-quiz', [QuizController::class, 'submitQuiz'])->name('submit.quiz');

            

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('home');
});

Route::post('/room/create', [RoomController::class, 'createRoom'])->name('room.create');
Route::post('/room/join', [RoomController::class, 'joinRoom'])->name('room.join');
Route::get('/room/participants/{roomId}', [RoomController::class, 'getParticipants'])->name('room.participants');

// Rute untuk bertanding dengan komputer
Route::post('/play-against-computer', [RoomController::class, 'playAgainstComputer'])->name('room.computer');

// Rute untuk mulai quiz
Route::post('/start-quiz', [QuizController::class, 'startQuiz'])->name('start.quiz');

Route::post('/submit-quiz', [QuizController::class, 'submitQuiz'])->name('submit.quiz');
            