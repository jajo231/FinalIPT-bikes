<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToBikesTable extends Migration
{
    public function up()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
