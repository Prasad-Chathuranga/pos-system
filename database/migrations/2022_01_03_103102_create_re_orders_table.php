<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('re_orders', function (Blueprint $table) {
            $table->id();
            $table->string("item_id")->nullable();
            $table->string("description")->nullable();
            $table->string("item_code")->nullable();
            $table->string("soh")->nullable();
            $table->string("new_soh")->nullable();
            $table->string("reorder_level")->nullable();
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
        Schema::dropIfExists('re_orders');
    }
}
