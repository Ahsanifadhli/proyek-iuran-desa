<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Ini akan membuat Primary Key 'id_user' tipe INT dan AUTO_INCREMENT
            $table->increments('id_user');

            $table->string('nama_lengkap', 100);

            // Tambahkan ->unique() agar tidak ada username yang sama
            $table->string('username', 50)->unique();

            $table->string('password');

            // WAJIB ADA untuk fitur "Ingat Saya" (Remember Me) di Laravel
            $table->rememberToken();

            $table->enum('role', ['Admin', 'RT', 'RW', 'Warga']);
            $table->string('no_hp', 15)->nullable();

            // Tambahkan ->unique() agar tidak ada email yang sama
            $table->string('email', 100)->nullable()->unique();

            $table->string('foto')->nullable();

            // boolean() adalah cara Laravel untuk tinyint(1)
            $table->boolean('is_active')->default(true);

            // Opsional, tapi disarankan oleh Laravel (jika perlu verifikasi email)
            $table->timestamp('email_verified_at')->nullable();

            // Sesuai SQL Anda: timestamp NULL DEFAULT current_timestamp()
            $table->timestamp('created_at')->nullable()->useCurrent();

            // KITA TIDAK MENAMBAHKAN updated_at,
            // karena model Anda di setting const UPDATED_AT = null;
            // $table->timestamps(); JANGAN DIPAKAI di sini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
