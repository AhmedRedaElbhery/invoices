<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_invoices');
            $table->string('product');
            $table->string('invoice_number');
            $table->foreign('id_invoices')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('section');
            $table->string('status');
            $table->unsignedBigInteger('value_status');
            $table->string('not')->nullable();
            $table->string('user');
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
        Schema::dropIfExists('invoices_details');
    }
}
