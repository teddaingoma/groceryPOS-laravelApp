<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommodityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commodity_types', function (Blueprint $table) {
            $table->id();
            $table->integer("commodity_id")->unsigned();
            $table->string("type_name");
            $table->timestamps();

            $table->foreign("commodity_id")
                    ->references("id")
                    ->on("commodities")
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
        Schema::dropIfExists('commodity_types');
    }
}
