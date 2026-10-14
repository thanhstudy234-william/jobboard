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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained();
            $table->string('title', 200);
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->decimal('salary_min', 12, 0)->nullable();
            $table->decimal('salary_max', 12, 0)->nullable();
            $table->string('location', 100)->nullable();
            $table->enum('job_type', ['full-time', 'part-time', 'remote'])->default('full-time');
            $table->date('deadline')->nullable();
            $table->enum('status', ['pending', 'approved', 'closed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
