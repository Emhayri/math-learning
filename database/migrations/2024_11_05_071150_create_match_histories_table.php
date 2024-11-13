<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('match_histories', function (Blueprint $table) {
            $table->id();
            $table->decimal('kecepatan', 5, 2)->nullable();
            $table->decimal('ketepatan', 5, 2)->nullable();
            $table->integer('benar')->default(0);
            $table->integer('salah')->default(0);
            $table->string('level');
            $table->integer('jumlah_soal');
            $table->timestamps();
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_histories');
    }
};
