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
            $table->string('gender');
            $table->string('full_name');
            $table->string('username')->unique();
            $table->string('job_title')->nullable();
            $table->string('category')->nullable();
            $table->string('img')->default('profileImgs/defult.jpg');
            $table->string('email')->unique();
            $table->string('phone');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('feedbacks')->default('[]');
            $table->longText('wishlist')->default('["jobs" => [] , "users" => []]');
            $table->integer('stars')->default(0);
            $table->float('hourly_price')->default(10.00);
            $table->string('country')->nullable();
            $table->longText('bio')->nullable();
            $table->integer('on_projects')->default(0);
            $table->integer('completed_projectes')->default(0);
            $table->integer('cancelled_projects')->default(0);
            $table->float('total_earning')->default(0.00);
            $table->float('currency')->default(0.00);
            $table->longText('projects')->default('[]');
            $table->longText('experiences')->default('[]');
            $table->longText('educations')->default('[]');
            $table->longText('skills')->default('[]');
            $table->string('langs')->default('[]');
            $table->longText('notifications')->default('[]');
            $table->string('type')->default('freelancer');
            $table->string('english_level')->nullable();
            $table->string('freelancer_type')->nullable();
            $table->string('token')->nullable()->default('');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
