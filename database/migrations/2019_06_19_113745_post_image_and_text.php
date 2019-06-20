<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostImageAndText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imageAndText', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('postId')->unsigned();
            $table->string('url', 191);
            $table->string('title', 191)->nullable();
            $table->enum('imagePosition', ['left', 'right']);
            $table->longText('content');
            $table->integer('order')->unsigned();
            $table->softDeletes();
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
        //
    }
}
