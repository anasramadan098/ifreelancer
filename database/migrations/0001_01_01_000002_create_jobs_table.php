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
        // Schema::create('jobs', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('queue')->index();
        //     $table->longText('payload');
        //     $table->unsignedTinyInteger('attempts');
        //     $table->unsignedInteger('reserved_at')->nullable();
        //     $table->unsignedInteger('available_at');
        //     $table->unsignedInteger('created_at');
        // });
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('bio');
            $table->string('categories');
            $table->json('skills');
            $table->json('faq')->nullable()->default('');
            $table->string('english_level');
            $table->string('freelancer')->nullable();
            $table->string('status')->default('active');
            $table->string('job_type');
            $table->string('freelancer_type');
            $table->string('project_length');
            $table->string('radio_price');
            $table->integer('price_min');
            $table->integer('price_max');
            $table->integer('user_id');
            $table->string('user_country');
            $table->string('user_name');
            $table->timestamps();
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
