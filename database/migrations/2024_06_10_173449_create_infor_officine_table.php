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
        Schema::create('infor_officine', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Pour les titres (h1, h2, h5)
            $table->text('content'); // Pour les paragraphes (p)
            $table->string('type'); // Pour spécifier le type (h1, h2, h5, p)
            $table->integer('order')->default(0); // Pour maintenir l'ordre des éléments
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infor_officine');
    }
};
