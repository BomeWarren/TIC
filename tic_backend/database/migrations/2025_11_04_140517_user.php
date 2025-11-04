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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password'); // 'motDePasse' devient 'password' par convention
            $table->string('photoProfil')->nullable();
            $table->text('bio')->nullable();
            $table->string('specialite')->nullable();
            $table->rememberToken();
            $table->timestamps(); // Crée 'created_at' (pour 'dateInscription') et 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
