<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeCostPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_cost_prices', function (Blueprint $table) {
            $table->increments('id')->onDelete('cascade');
            $table->float('type_cost_price');
            $table->unsignedInteger('commodity_type_id');
            $table->timestamps();

            $table->foreign('commodity_type_id')
                    ->references('id')
                    ->on('commodity_types')
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
        Schema::dropIfExists('type_cost_prices');
    }
}
