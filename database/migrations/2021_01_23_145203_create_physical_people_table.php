<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v1.physical_people', function (Blueprint $table) {
            $table->string('person_id')->unique();
            $table->timestamp('birth_date');
            $table->primary('person_id');
            $table->foreign('person_id')->references('id')->on('v1.people');
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
        Schema::dropIfExists('v1.physical_people');
    }
}
