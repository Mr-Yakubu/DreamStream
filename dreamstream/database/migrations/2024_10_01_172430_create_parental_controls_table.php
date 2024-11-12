<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentalControlsTable extends Migration
{
    public function up()
    {
        Schema::create('parental_controls', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to users
            $table->unsignedBigInteger('child_user_id'); // Foreign key to child's user_id (the parent-child relationship)
            $table->unsignedInteger('age_limit'); // Age limit
            $table->text('restricted_keywords')->nullable(); // Restricted keywords
            $table->string('time_limits')->nullable(); // Time limits
            $table->unsignedInteger('dislikes')->default(0); // Dislikes count
            $table->timestamps(); // Created and updated timestamps
        
            // Foreign key to the parent (user_id references users table)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        
            // Foreign key to the child (child_user_id references users table)
            $table->foreign('child_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('parental_controls');
    }
}
