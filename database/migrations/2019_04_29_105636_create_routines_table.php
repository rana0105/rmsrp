<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('day_id');
            $table->integer('semester_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('section');
            $table->string('academic_year');
            $table->integer('faculty_id')->unsigned();
            $table->integer('time_slots_id')->unsigned();
            $table->integer('class_room_id')->unsigned(); 
            $table->string('room_type');           
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
        Schema::dropIfExists('routines');
    }
}
