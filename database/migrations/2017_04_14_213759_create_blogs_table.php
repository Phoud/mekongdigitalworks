<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->index();
            $table->text('body');
            $table->text('description');
            $table->string('slug');
            $table->integer('order')->nullable();
            $table->enum('type', ['blog', 'recipe', 'promotion', 'special']);
            $table->enum('status', ['published', 'unpublished']);
            $table->integer('category_id')->nullable()->unsigned();
            $table->string('img_title')->nullable();
            $table->string('start')->nullable();
            $table->string('expire')->nullable();
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
        Schema::dropIfExists('blogs');
    }
}
