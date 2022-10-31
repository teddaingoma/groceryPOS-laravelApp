<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeSellInvoivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_sell_invoives', function (Blueprint $table) {
            $table->increments('id')->onDelete('cascade');
            $table->unsignedInteger('commodity_id');
            $table->unsignedInteger('commodity_type_id');
            $table->unsignedInteger('sell_quantity');
            $table->float('selling_price')->unsigned();
            $table->float('total_cost')->unsigned()->nullable();
            $table->float('payment')->unsigned();
            $table->float('change')->unsigned()->nullable();
            $table->unsignedInteger('owner_id')->nullable();
            $table->unsignedInteger('customer_id')->nullable();
            $table->timestamp('date_time');
            $table->timestamps();

            $table->foreign('commodity_id')
                    ->references('id')
                    ->on('commodities')
                    ->onDelete('cascade')
            ;

            $table->foreign('commodity_type_id')
                    ->references('id')
                    ->on('commodity_types')
                    ->onDelete('cascade')
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_sell_invoives');
    }
}
