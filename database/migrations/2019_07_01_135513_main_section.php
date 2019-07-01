<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MainSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mainSection', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first', '100');
            $table->string('second', '100');
            $table->string('third', '100');
            $table->string('fourth', '100');
            $table->string('fifth', '100');
            $table->string('sixth', '100');
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
