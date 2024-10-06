<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('video_id'); // Foreign key to videos
            $table->unsignedBigInteger('user_id'); // Foreign key to users
            $table->text('content'); // Comment content
            $table->unsignedInteger('likes')->default(0); // Likes count
            $table->unsignedInteger('dislikes')->default(0); // Dislikes count
            $table->timestamps(); // Created and updated timestamps

            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade'); // Foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
