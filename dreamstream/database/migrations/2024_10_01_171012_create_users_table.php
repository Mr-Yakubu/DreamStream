<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('username')->unique();
            $table->string('password'); // Password (hashed)
            $table->string('email')->unique(); // Unique email
            $table->string('user_type')->default('child'); // Role with a default value
            $table->date('date_of_birth')->nullable(); // Date of birth (optional)
            $table->rememberToken(); // Token for "remember me" functionality
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
