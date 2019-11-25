<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('invoice', function (Blueprint $table) {
            $table->increments('invoiceid');
            $table->integer('invoiceuserid')->nullable();
            $table->string('invoiceusername')->nullable();
            $table->integer('invoicebankid')->nullable();
            $table->string('invoiceback')->nullable();
            $table->integer('invoicetype')->nullable();
            $table->integer('invoicelist')->nullable();
            $table->float('invoiceprice')->nullable();
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
        Schema::dropIfExists('invoice');
    }
}
