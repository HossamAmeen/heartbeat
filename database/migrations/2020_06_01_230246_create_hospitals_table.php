<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('hospitals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('phone');
            $table->string('manager_name');
            $table->string('manager_phone');
            $table->string('manager_email');
            $table->string('password');
            $table->string('type');
            $table->boolean('is_government');
            $table->integer('number_of_medium_care_beds')->default(0);
            $table->integer('number_of_interior_care_beds')->default(0);
            $table->integer('number_of_intensive_care_beds')->default(0);
            $table->boolean('is_approved')->default(0);
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
        Schema::dropIfExists('hospitals');
    }
}
