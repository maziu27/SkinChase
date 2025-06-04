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
        Schema::table('trades', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->after('item_name');
            $table->string('image')->after('price');

            $table->string(column: 'status')->default('completed')->after('image');

            $table->string('payment_method')->nullable()->after('status');

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trades', function (Blueprint $table) {
            // Revertir los cambios si se hace rollback
            $table->dropColumn('price');
            $table->dropColumn('image');
            $table->dropColumn('status');
            $table->dropColumn('payment_method');
            $table->dropIndex(['status']);
        });
    }
};
