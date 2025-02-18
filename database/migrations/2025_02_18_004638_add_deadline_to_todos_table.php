<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dateTime('deadline')->nullable();
        });
    }

    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('deadline');
        });
    }
};
