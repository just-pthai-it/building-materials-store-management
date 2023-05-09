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
        Schema::create('specifications', function (Blueprint $table)
        {
            $table->unsignedSmallInteger('id')->autoIncrement();
            $table->unsignedSmallInteger('product_id');
            $table->float('price');
            $table->unsignedSmallInteger('current_amount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () : void
    {
        Schema::dropIfExists('specifications');
    }
};
