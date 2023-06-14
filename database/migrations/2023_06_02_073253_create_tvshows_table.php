<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvshowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvshows', function (Blueprint $table) {
            $table->id();
            $table->string('name_rm');
            $table->string('name_jp');
            $table->string('name_en')->nullable();
            $table->string('image')->nullable();
            $table->string('imagename')->nullable();
            $table->string('filename')->nullable();
            $table->string('file')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('episodes')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('tvshows');
    }
}
