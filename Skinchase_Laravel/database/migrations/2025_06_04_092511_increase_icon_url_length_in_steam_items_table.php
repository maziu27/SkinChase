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
        //aumenta el tamaño permitido de URL de la foto de los steam_items ya que algunos daban error SQL por exceso de tamaño
        Schema::table('steam_items', function (Blueprint $table) {
            Schema::table('steam_items', function (Blueprint $table) {
                // Cambiar la longitud de icon_url a 700 caracteres
                $table->string('icon_url', 700)->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('steam_items', function (Blueprint $table) {
            $table->string('icon_url')->change();

        });
    }
};
