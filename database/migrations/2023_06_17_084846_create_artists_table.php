<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name_rm');
            $table->string('name_jp');
            $table->string('profile_page');
            $table->string('twitter_account')->nullable();
            $table->string('blog')->nullable();
            $table->string('tiktok_account')->nullable();
            $table->string('instagram_account')->nullable();
            $table->string('youtube_account')->nullable();
            $table->date('join_date');
            $table->date('graduation_date')->nullable();
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
        Schema::dropIfExists('artists');
    }
}
