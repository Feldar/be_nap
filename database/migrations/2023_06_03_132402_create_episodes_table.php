<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->integer('episode_number');
            $table->string('name_rm');
            $table->string('name_jp')->nullable();
            $table->string('name_en')->nullable();
            $table->string('format');
            $table->string('resolution');
            $table->timestamps();
            $table->date('release_date');
            $table->string('type');
            $table->integer('duration');
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
