<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->string("invoice_id")->nullable();
            $table->string("invoice_no")->nullable();
            $table->string("item_no")->nullable();
            $table->string("item_code")->nullable();
            $table->string("description")->nullable();
            $table->string("price")->nullable();      
            $table->string("quantity")->nullable();
            $table->string("before_quantity")->nullable();
            $table->string("total")->nullable();
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
        Schema::dropIfExists('invoice_items');
    }
}
