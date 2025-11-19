<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user'); // Primary Key: id_user (Tipe INT)
            $table->string('nama_lengkap', 100);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->enum('role', ['Admin', 'RT', 'RW', 'Warga']);
            $table->string('no_hp', 15)->nullable();
            $table->string('email', 100)->nullable()->unique();
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
