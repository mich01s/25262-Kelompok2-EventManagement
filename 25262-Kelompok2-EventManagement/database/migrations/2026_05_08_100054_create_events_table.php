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
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->foreignId("organizer_id")->constrained('profil_organizers')->onDelete('cascade');
            $table->foreignId("kategori_id")->constrained('kategori_events')->onDelete('cascade');
            $table->string('nama_event');
            $table->date('tanggal_mulai');
            $table->string('lokasi');
            $table->string('google_maps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
