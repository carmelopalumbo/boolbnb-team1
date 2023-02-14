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
        Schema::create('property_sponsor', function (Blueprint $table) {
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')
                ->references('id')
                ->on('sponsors')
                ->cascadeOnDelete();

            $table->dateTime('start_date');
            $table->dateTime('end_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_sponsor');
    }
};
