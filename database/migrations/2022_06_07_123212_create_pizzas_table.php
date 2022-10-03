<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id("pizza_id");
            $table->string("pizza_name");
            $table->string("pizza_image");
            $table->integer("pizza_price");
            $table->boolean("publish_status");
            $table->integer('category_id');
            $table->integer('discount_price');
            $table->boolean('buy_one_get_one_status');
            $table->integer('waiting_time');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
};
