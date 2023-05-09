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
        Schema::create('units', function (Blueprint $table)
        {
            $table->unsignedTinyInteger('id')->autoIncrement();
            $table->string('name');
            $table->unsignedTinyInteger('parent_id')->nullable();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down ()
    {
        Schema::dropIfExists('units');
    }
};
