<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name_rm');
            $table->string('name_jp');
            $table->string('profile_page');
            $table->string('twitter_account')->nullable();
            $table->string('youtube_account')->nullable();
            $table->string('color');
            $table->date('join_date');
            $table->date('graduation_date')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('artist_id');
            $table->foreign('artist_id')->references('id')->on('artists');
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
        Schema::dropIfExists('characters');
    }
}
