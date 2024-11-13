<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Rute untuk halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk quiz
Route::post('/start-quiz', [QuizController::class, 'startQuiz'])->name('start.quiz');
Route::post('/submit-quiz', [QuizController::class, 'submitQuiz'])->name('submit.quiz');

// Rute untuk room
// Route::middleware(['auth'])->group(function () {
//     Route::post('/room/create', [RoomController::class, 'createRoom'])->name('room.create');
//     Route::post('/room/join', [RoomController::class, 'joinRoom'])->name('room.join');
//     Route::post('/room/leave', [RoomController::class, 'leaveRoom'])->name('room.leave');
//     Route::get('/room/participants/{code}', [RoomController::class, 'getParticipants'])->name('room.participants');
//     Route::post('/room/computer', [RoomController::class, 'playAgainstComputer'])->name('room.computer');
// });

// Rute untuk profil pengguna
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute untuk admin
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index']);
});

// Rute untuk halaman guest
Route::get('/guest-page', function () {
    return view('home');
})->middleware('role:Guest');

// Rute untuk otentikasi
require __DIR__.'/auth.php';

Route::get('/api/match-history', [QuizController::class, 'getMatchHistory']);
