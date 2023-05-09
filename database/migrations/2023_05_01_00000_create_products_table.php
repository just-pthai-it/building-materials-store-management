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
        Schema::create('products', function (Blueprint $table)
        {
            $table->unsignedSmallInteger('id')->autoIncrement();
            $table->unsignedTinyInteger('category_id');
            $table->string('name')->nullable();
            $table->string('brand_name')->nullable();
            $table->string('description')->nullable();
            $table->unsignedTinyInteger('tax')->nullable();
            $table->unsignedTinyInteger('unit_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () : void
    {
        Schema::dropIfExists('products');
    }
};
