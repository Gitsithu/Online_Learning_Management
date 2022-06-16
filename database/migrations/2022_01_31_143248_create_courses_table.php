<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('Categories_ID');
            $table->string('title');
            $table->string('author');

            $table->string('fee');
            $table->string('duration');
            $table->Date('published_date');

            $table->string('video')->nullable();
            $table->string('Image')->nullable();

            $table->string('description');
            $table->string('remark');

            $table->string('status');
            $table->rememberToken();

            $table->timestamps();
            $table->SoftDeletes();
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
}
