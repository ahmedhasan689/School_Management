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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->date('date_birth');
            $table->string('academic_year');

            // Foreign Ids
            $table->foreignId('gender_id')->unsigned()->constrained('genders')->cascadeOnDelete();
            $table->foreignId('nationality_id')->unsigned()->constrained('nationalities')->cascadeOnDelete();
            $table->foreignId('blood_type_id')->unsigned()->constrained('blood_types')->cascadeOnDelete();
            $table->foreignId('grade_id')->unsigned()->constrained('grades')->cascadeOnDelete();
            $table->foreignId('classroom_id')->unsigned()->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('section_id')->unsigned()->constrained('sections')->cascadeOnDelete();
            $table->foreignId('parent_id')->unsigned()->constrained('my_parents')->cascadeOnDelete();

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
        Schema::dropIfExists('students');
    }
};
