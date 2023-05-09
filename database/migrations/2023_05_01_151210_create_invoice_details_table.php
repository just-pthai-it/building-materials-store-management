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
        Schema::create('invoice_details', function (Blueprint $table)
        {
            $table->unsignedMediumInteger('id')->autoIncrement();
            $table->unsignedMediumInteger('invoice_id');
            $table->unsignedMediumInteger('commodity_id');
            $table->unsignedSmallInteger('amount')->nullable();
            $table->float('price')->nullable();

            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('commodity_id')->references('id')->on('commodities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () : void
    {
        Schema::dropIfExists('invoice_details');
    }
};
