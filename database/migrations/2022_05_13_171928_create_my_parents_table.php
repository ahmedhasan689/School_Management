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
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            // Father Info
            $table->string('father_name');
            $table->string('father_national_id');
            $table->string('father_passport_id');
            $table->string('father_phone');
            $table->string('father_job');
            $table->string('father_address');
                // Foreign Key For Father
            $table->foreignId('nationality_father_id')->unsigned()->constrained('naltionalities')->cascadeOnDelete();
            $table->foreignId('blood_types_father_id')->unsigned()->constrained('blood_types')->cascadeOnDelete();
            $table->foreignId('religions_father_id')->unsigned()->constrained('religions')->cascadeOnDelete();

            // Mother Info
            $table->string('mother_name');
            $table->string('mother_national_id');
            $table->string('mother_passport_id');
            $table->string('mother_phone');
            $table->string('mother_job');
            $table->string('mother_address');
                // Foreign Key For mother
            $table->foreignId('nationality_mother_id')->unsigned()->constrained('naltionalities')->cascadeOnDelete();
            $table->foreignId('blood_type_mother_id')->unsigned()->constrained('blood_types')->cascadeOnDelete();
            $table->foreignId('religion_mother_id')->unsigned()->constrained('religions')->cascadeOnDelete();

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
        Schema::dropIfExists('my_parents');
    }
};
