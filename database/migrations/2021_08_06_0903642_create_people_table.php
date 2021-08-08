<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->char('remote_id', 24);
            $table->integer('remote_uid');
            $table->string('name');
            $table->integer('height');
            $table->integer('mass');
            $table->string('hair_color');
            $table->string('skin_color');
            $table->string('eye_color');
            $table->string('birth_year');
            /** Could have used enums, but I found this interesting http://komlenic.com/244/8-reasons-why-mysqls-enum-data-type-is-evil/ */
            $table->string('gender');
            $table->foreignUuid('planet_uuid')->constrained('planets' ,'uuid')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('people');
    }
}
