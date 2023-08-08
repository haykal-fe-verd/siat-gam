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
        Schema::create('tb_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sumber_dana');
            $table->string('nomor_pengeluaran');
            $table->string('nama_kegiatan');
            $table->string('penanggung_jawab');
            $table->string('lama_kegiatan');
            $table->date('tanggal_pengeluaran');
            $table->integer('jumlah_pengeluaran');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->enum('laporan_akhir', ['menunggu', 'disetujui'])->default('menunggu');
            $table->text('pesan')->nullable();
            $table->string('gambar_awal')->nullable();
            $table->string('gambar_tengah')->nullable();
            $table->string('gambar_akhir')->nullable();
            $table->timestamps();

            $table->foreign('sumber_dana')->references('id')->on('tb_pemasukan')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengeluaran');
    }
};
