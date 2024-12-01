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

            $table->increments('id');
            $table->string('invoice_number')->unique();
            $table->date('invoice_Date');
            $table->string('product');
            $table->bigInteger('section_id');
            $table->foreign('section_id')->references('id')->on('section');
            $table->decimal('Amount_collection');
            $table->decimal('Amount_commission');
            $table->decimal('Discount');
            $table->date('due_date');
            $table->decimal('Value_VAT', 8, 2);
            $table->string('Rate_VAT');
            $table->decimal('Total', 8, 2);
            $table->string('Status', 50);
            $table->integer('Value_Status');
            $table->text('note')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->softDeletes();
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
