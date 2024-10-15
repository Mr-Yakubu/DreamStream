<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Title of the video
            $table->text('description')->nullable(); // Description
            $table->string('url'); // URL of the video
            $table->string('age_suitability')->nullable(); // Age suitability
            $table->unsignedBigInteger('uploaded_by'); // User ID of the uploader
            $table->string('thumbnail')->nullable(); // Thumbnail path
            $table->time('duration'); // Video duration
            $table->unsignedInteger('views')->default(0); // View count
            $table->unsignedInteger('likes')->default(0); // Like count
            $table->unsignedInteger('dislikes')->default(0); // Dislike count
            $table->timestamps(); // Created and updated timestamps

            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade'); // Foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
