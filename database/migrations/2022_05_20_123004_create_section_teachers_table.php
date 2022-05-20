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
        Schema::create('section_teachers', function (Blueprint $table) {
            $table->foreignId('section_id')->unsigned()->constrained('sections')->cascadeOnDelete();
            $table->foreignId('teacher_id')->unsigned()->constrained('teachers')->cascadeOnDelete();

            $table->primary([
                'section_id',
                'teacher_id',
            ]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_teachers');
    }
};
