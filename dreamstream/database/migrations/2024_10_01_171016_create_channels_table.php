<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name')->unique(); // Unique channel name
            $table->unsignedBigInteger('user_id'); // Foreign key to users
            $table->timestamps(); // Created and updated timestamps

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key
        });
    }

    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
