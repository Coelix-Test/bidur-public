<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
//        Schema::create('ratings', function (Blueprint $table) {
//            $table->increments('id');
//            $table->timestamps();
//            $table->integer('rating');
//            $table->integer('rating_item');
//            $table->string('review');
//            $table->morphs('rateable');
//            $table->unsignedInteger('user_id')->index();
//            $table->index('rateable_id');
//            $table->index('rateable_type');
//            $table->softDeletes();
//            $table->foreign('user_id')->references('id')->on('users');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('ratings');
    }
}
