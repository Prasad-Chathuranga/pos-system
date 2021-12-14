<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Items', function (Blueprint $table) {
            $table->id();
            $table->string('item_no');
            $table->string('item_code');
            $table->string('description');
            $table->string('soh');
            $table->string('bin');
            $table->string('cost_price');
            $table->string('sale_price');
            $table->string('reorder_level');
            $table->string('status');
            $table->string('country');
            $table->string('category_code');
            $table->string('category');
            $table->string('max_category_id');
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
        Schema::dropIfExists('Items');
    }
}
