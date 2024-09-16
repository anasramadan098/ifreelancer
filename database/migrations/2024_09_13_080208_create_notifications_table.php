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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->unsignedBigInteger('project_id');
            $table->string('type');
            $table->text('content');
            $table->boolean('read')->default(false);
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();  // Adds a 'deleted_at' column for soft deletion. If a notification is deleted, it won't be removed from the database immediately. Instead, it will be marked as deleted.
            $table->engine = 'InnoDB';  // Sets the table engine to InnoDB, which provides better performance and ACID (Atomicity, Consistency, Isolation, Durability) properties for transactions.
            $table->rememberToken();  // Adds a'remember_token' column for automatically logging out users after a certain period of inactivity. This helps prevent session hijacking attacks.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
