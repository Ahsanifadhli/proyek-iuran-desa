<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rt', function (Blueprint $table) {
            $table->id('id_rt');
            $table->string('no_rt');
            $table->foreignId('id_rw')->constrained('rw', 'id_rw'); // Nyambung ke 'rw'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rt');
    }
};
