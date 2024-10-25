<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
{
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->foreignId('creator_id')->constrained('users');
        $table->foreignId('opponent_id')->nullable()->constrained('users');
        $table->string('code', 6)->unique();
        $table->enum('status', ['waiting', 'active', 'finished']);
        $table->enum('level', ['mudah', 'medium', 'sulit']);
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
