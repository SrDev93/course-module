<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('banner')->nullable();

            $table->string('duration')->nullable();
            $table->integer('course_count')->nullable();
            $table->integer('student_count')->nullable();
            $table->string('level')->nullable();
            $table->string('language')->nullable();

            $table->unsignedInteger('visit')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('courses');
    }
};
