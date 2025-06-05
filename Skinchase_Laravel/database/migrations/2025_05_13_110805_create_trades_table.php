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
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            
            //relacionarlo con la tabla users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('user_name');

            //relacionarlo con la tabla items
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->string('item_name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trades');
    }
};
