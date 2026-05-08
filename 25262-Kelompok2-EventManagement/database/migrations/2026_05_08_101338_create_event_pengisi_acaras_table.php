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
        Schema::create('event_pengisi_acaras', function (Blueprint $table) {
            $table->id('event_pengisi_id');
            $table->foreignId('event_id')->constrained('events','event_id')->onDelete('cascade');
            $table->foreignId('pengisi_acara_id')->constrained('pengisi_acaras','pengisi_acara_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_pengisi_acaras');
    }
};
