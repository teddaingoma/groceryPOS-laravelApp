<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_purchase_invoices', function (Blueprint $table) {
            $table->increments('id')->onDelete('cascade');
            $table->unsignedInteger('commodity_id');
            $table->unsignedInteger('commodity_type_id');
            $table->unsignedInteger('quantity');
            $table->float('cost_price')->unsigned();
            $table->float('selling_price')->unsigned();
            $table->integer("user_id")->unsigned();
            $table->unsignedInteger('supplier_id')->nullable();
            $table->timestamp('date_time');
            $table->timestamps();

            $table->foreign('commodity_id')
                    ->references('id')
                    ->on('commodities')
                    ->onDelete('cascade');

            $table->foreign('commodity_type_id')
                    ->references('id')
                    ->on('commodity_types')
                    ->onDelete('cascade')
            ;

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
        Schema::dropIfExists('type_purchase_invoices');
    }
}
