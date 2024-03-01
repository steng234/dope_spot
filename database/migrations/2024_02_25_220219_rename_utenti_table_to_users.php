<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('Utenti', function (Blueprint $table) {
            $table->string('google_id')->after('provincia')->nullable()->unique();
        });
    }

    public function down()
    {
        Schema::table('Utenti', function (Blueprint $table) {
            $table->dropColumn('google_id');
        });
    }
};
