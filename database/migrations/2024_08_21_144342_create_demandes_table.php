<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('request_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('etablissement_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('request_type_id');
            $table->unsignedBigInteger('etablissement_type_id');
            $table->string('status')->default('Reçu');
            $table->string('etape')->default('Prétraitement');
            $table->foreignId('region_id')->nullable()->constrained();
            $table->foreignId('prefecture_id')->nullable()->constrained();
            $table->string('sous_prefecture')->nullable();
            $table->string('district')->nullable();
            $table->string('ref_op')->nullable();
            $table->string('ref_diplome')->nullable();
            $table->string('quartier')->nullable();
            $table->string('site')->nullable();
            $table->timestamps();

            // Ajout des clés étrangères
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('request_type_id')->references('id')->on('request_types')->onDelete('cascade');
            $table->foreign('etablissement_type_id')->references('id')->on('etablissement_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
        Schema::dropIfExists('etablissement_types');
        Schema::dropIfExists('request_types');
    }
};
