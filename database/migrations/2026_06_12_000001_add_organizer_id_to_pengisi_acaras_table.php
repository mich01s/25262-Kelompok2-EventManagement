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
        Schema::table('pengisi_acaras', function (Blueprint $table) {
            $table->foreignId('organizer_id')
                ->nullable()
                ->after('pengisi_acara_id')
                ->constrained('profil_organizers', 'organizer_id')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengisi_acaras', function (Blueprint $table) {
            $table->dropConstrainedForeignId('organizer_id');
        });
    }
};