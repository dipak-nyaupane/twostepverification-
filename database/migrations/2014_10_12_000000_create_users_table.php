<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile_number')->nullable();
            $table->integer('gender')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('user_role')->nullable();
            $table->text('user_description')->nullable();
            $table->string('profile_picture', 2048)->nullable();
            $table->datetime('join_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
