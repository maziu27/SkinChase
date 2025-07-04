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
        // crea la tabla items
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id')->unique();
            $table->string('name');
            $table->string('icon_url');
            $table->decimal('price', 8, 2);
            $table->float('float_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
