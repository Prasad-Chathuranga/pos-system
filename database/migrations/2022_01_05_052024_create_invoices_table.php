<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("order_no")->nullable();
            $table->string("invoice_no")->nullable();
            $table->string("invoice_by")->nullable();
            $table->string("customer_code")->nullable();
            $table->string("customer_name")->nullable();
            $table->string("customer_mobile")->nullable();
            $table->string("type")->nullable();
            $table->string("total_amount")->nullable();
            $table->string("discount_amount")->nullable();
            $table->string("net_amount")->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
