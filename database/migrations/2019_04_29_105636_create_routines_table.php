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
            $table->integer('day_id')->unsigned();
            $table->integer('semester_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->string('section');
            $table->string('Academic Year');
            $table->integer('faculty_id')->unsigned();
            $table->integer('time_slots_id')->unsigned();
            $table->integer('class_room_id')->unsigned();            
            $table->timestamps();

            $table->foreign('day_id')->references('id')->on('week_days')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('semester_id')->references('id')->on('semesters')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('time_slots_id')->references('id')->on('time_slots')->onUpdate('cascade')->onDelete('cascade');                    
            $table->foreign('class_room_id')->references('id')->on('class_rooms')->onUpdate('cascade')->onDelete('cascade');        
            $table->foreign('faculty_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');                       
            
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
