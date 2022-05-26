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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->unsigned()->constrained('students')->cascadeOnDelete();

            $table->foreignId('from_grade')->unsigned()->constrained('grades')->cascadeOnDelete();
            $table->foreignId('from_classroom')->unsigned()->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('from_section')->unsigned()->constrained('sections')->cascadeOnDelete();

            $table->foreignId('to_grade')->unsigned()->constrained('grades')->cascadeOnDelete();
            $table->foreignId('to_classroom')->unsigned()->constrained('classrooms')->cascadeOnDelete();
            $table->foreignId('to_section')->unsigned()->constrained('sections')->cascadeOnDelete();

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
        Schema::dropIfExists('promotions');
    }
};
