<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatestTable extends Migration
{
    public function up()
    {
        Schema::create('latest', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('video_id'); // Foreign key to videos
            $table->timestamps(); // Created and updated timestamps

            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade'); // Foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('latest');
    }
}
