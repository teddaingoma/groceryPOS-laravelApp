<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeBudgetedSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_budgeted_sales', function (Blueprint $table) {
            $table->increments('id')->onDelete('cascade');
            $table->unsignedInteger('commodity_id')->nullable();
            $table->unsignedInteger('commodity_type_id');
            $table->float('quantity');
            $table->float('selling_price');
            $table->timestamp('sales_date');
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

            $table->integer("user_id")->unsigned();

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
        Schema::dropIfExists('type_budgeted_sales');
    }
}
