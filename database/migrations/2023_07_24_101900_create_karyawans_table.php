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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_lengkap');
            $table->string('email')->unique();

            $table->foreign("departemen_id")->references("id")->on("departemens")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("kota_id")->references("id")->on("kotas")->cascadeOnDelete()->cascadeOnUpdate();
            $
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
