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
        Schema::create('versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table 'apps'
            $table->string('code')->unique(); // Code de version, ex : '1.1.1'
            $table->json('changelog'); // Description des modifications
            $table->string('path'); // Chemin vers le dossier contenant la mise à jour
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versions');
    }
};
