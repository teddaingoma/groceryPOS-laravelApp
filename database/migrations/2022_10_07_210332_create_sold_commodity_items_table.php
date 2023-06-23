<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldCommodityItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_commodity_items', function (Blueprint $table) {
            $table->increments('id')->onDelete('cascade');
            $table->unsignedInteger('commodity_id');
            $table->unsignedInteger('sold_quantity');
            $table->float('selling_price');
            $table->integer("user_id")->unsigned();
            $table->timestamps();

            $table->foreign('commodity_id')
                    ->references('id')
                    ->on('commodities')
                    ->onDelete('cascade');

            $table->foreign("user_id")
                    ->references("id")
                    ->on("users")
                    ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sold_commodity_items');
    }
}
