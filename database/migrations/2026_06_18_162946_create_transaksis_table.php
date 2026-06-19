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
        if (Schema::hasTable('transaksis')) {
            return;
        }

        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->string('nama_pelanggan');
            $table->string('no_hp');

            $table->foreignId('layanan_id')
                  ->constrained('layanans')
                  ->cascadeOnDelete();

            $table->decimal('berat', 8, 2);

            $table->bigInteger('total_harga');

            $table->enum('status', [
                'Masuk',
                'Diproses',
                'Selesai',
                'Diambil'
            ])->default('Masuk');

            $table->timestamp('tanggal_masuk')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();

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
