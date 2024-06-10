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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('type_demande');
            $table->unsignedBigInteger('pharmacie_id');
            $table->foreign('pharmacie_id')->references('id')->on('pharmacies')->onDelete('cascade');
            $table->unsignedBigInteger('agent_traitant_id')->nullable();
            $table->foreign('agent_traitant_id')->references('id')->on('agents_traitants')->onDelete('set null');
            $table->string('etat');
            $table->string('statut_traitement')->default('en_attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
