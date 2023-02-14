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
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 110)->unique();
            $table->string('size', 10)->nullable();
            $table->text('description');
            $table->string('cover_image');
            $table->smallInteger('rooms')->unsigned()->nullable();
            $table->smallInteger('beds')->unsigned();
            $table->smallInteger('bathrooms')->unsigned()->nullable();
            $table->tinyInteger('is_visible');
            $table->tinyInteger('is_sponsored');
            $table->decimal('price')->unsigned();
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('properties');
    }
};
