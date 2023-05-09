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
        Schema::create('input_invoices', function (Blueprint $table)
        {
            $table->unsignedMediumInteger('id')->autoIncrement();
            $table->unsignedSmallInteger('supplier_id');
            $table->unsignedSmallInteger('user_id');
            $table->string('payment_method')->nullable();
            $table->string('supplier_bank')->nullable();
            $table->string('supplier_bank_account_number')->nullable();
            $table->string('deliver_name')->nullable();
            $table->string('deliver_phone')->nullable();
            $table->float('total')->nullable();
            $table->timestamp('created_at');

            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('input_invoices');
    }
};
