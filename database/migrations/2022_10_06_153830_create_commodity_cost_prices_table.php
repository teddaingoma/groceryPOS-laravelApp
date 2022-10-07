<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommodityCostPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity_cost_prices', function (Blueprint $table) {
            $table->increments('id')->onDelete('cascade');
            $table->float('cost_price');
            $table->unsignedInteger('commodity_id');
            $table->timestamps();

            // Foreign Key
            $table->foreign('commodity_id')
                    ->constrained()
                    ->references('id')
                    ->on('commodities')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commodity_cost_prices');
    }
}
