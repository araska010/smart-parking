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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('plat_nomor');
            $table->foreignId('area_parkir_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tarif_parkir_id')->constrained()->cascadeOnDelete();
            $table->string('merk');
            $table->string('model');
            $table->string('warna');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->dateTime('waktu_masuk');
            $table->dateTime('waktu_keluar')->nullable();
            $table->integer('durasi_jam')->nullable();
            $table->decimal('total_bayar', 10, 2)->nullable();

            $table->enum('status', ['masuk', 'keluar'])->default('masuk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
