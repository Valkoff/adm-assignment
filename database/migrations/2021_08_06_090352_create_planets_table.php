<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->char('remote_id', 24);
            $table->integer('remote_uid');
            $table->string('name');
            $table->integer('diameter');
            $table->integer('rotation_period');
            $table->integer('orbital_period');
            $table->string('gravity');
            $table->string('population');
            $table->string('climate');
            $table->string('terrain');
            $table->integer('surface_water');
            $table->string('description');
            $table->string('url');
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
        Schema::dropIfExists('planets');
    }
}
