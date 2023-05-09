<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () : void
    {
        Schema::create('input_invoice_details', function (Blueprint $table)
        {
            $table->unsignedMediumInteger('id')->autoIncrement();
            $table->unsignedMediumInteger('input_invoice_id');
            $table->unsignedMediumInteger('commodity_id');
            $table->unsignedSmallInteger('amount')->nullable();
            $table->float('price')->nullable();

            $table->foreign('input_invoice_id')->references('id')->on('input_invoices');
            $table->foreign('commodity_id')->references('id')->on('commodities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('input_invoice_details');
    }
};
