<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBikePurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('bike_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bike_id');
            $table->timestamp('purchase_date');
            // Add other columns as needed
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bike_id')->references('id')->on('bikes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bike_purchases');
    }
}

