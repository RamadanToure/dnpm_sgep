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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->string('nom_pharmacie');
            $table->string('repere_facile');
            $table->double('latitude');
            $table->double('longitude');
            $table->double('altitude')->nullable();
            $table->string('titulaire_pharmacie');
            $table->string('telephone_titulaire');
            $table->string('email_pharmacie');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
