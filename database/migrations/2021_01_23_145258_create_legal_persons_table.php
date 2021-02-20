<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v1.legal_persons', function (Blueprint $table) {
            $table->string('person_id')->unique();
            $table->string('company_name');
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
        Schema::dropIfExists('v1.legal_persons');
    }
}
