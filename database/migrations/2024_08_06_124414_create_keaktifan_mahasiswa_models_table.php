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
        Schema::create('keaktifan_mahasiswa_models', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa');
            $table->string('nim');
            $table->string('semester');
            $table->string('data_kegiatan');
            $table->string('file_kegiatan');
            $table->string('point_kegiatan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keaktifan_mahasiswa_models');
    }
};
