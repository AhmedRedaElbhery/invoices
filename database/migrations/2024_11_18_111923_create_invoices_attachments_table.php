<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_attachments', function (Blueprint $table) {
            $table->id();
            $table->string("file_name");
            $table->string("invoice_number");
            $table->string("created_by");
            $table->unsignedBigInteger("invoices_id")->nullable();
            $table->foreign("invoices_id")->references("id")->on("invoices")->onDelete("cascade");
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
        Schema::dropIfExists('invoices_attachments');
    }
}
