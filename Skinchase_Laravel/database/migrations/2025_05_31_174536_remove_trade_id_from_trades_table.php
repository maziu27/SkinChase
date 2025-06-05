<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTradeIdFromTradesTable extends Migration
{
    public function up()
    {
        // quita la columna trade_id de trades
        Schema::table('trades', function (Blueprint $table) {
            if (Schema::hasColumn('trades', 'trade_id')) {
                $table->dropColumn('trade_id');
            }
        });
    }

    public function down()
    {
        Schema::table('trades', function (Blueprint $table) {
            $table->string('trade_id')->unique();
        });
    }
}