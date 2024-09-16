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
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Primary key for the message
            $table->unsignedBigInteger('sender_id'); // ID of the user who sent the message
            $table->unsignedBigInteger('receiver_id'); // ID of the user who received the message
            $table->unsignedBigInteger('project_id'); // ID of the user who received the message
            $table->unsignedBigInteger('conversation_id'); // ID of the user who received the message
            $table->text('content'); // The actual message text
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
