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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_post_id')->constrained('job_posts')->cascadeOnDelete();
            $table->foreignId('candidate_id')->constrained('users');
            $table->string('cv_file');
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['new', 'viewed', 'interview', 'rejected', 'accepted'])->default('new');
            $table->timestamps();
            $table->unique(['job_post_id', 'candidate_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
