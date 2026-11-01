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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('teacher_code')->unique();

            $table->string('phone', 20)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('department')->nullable();
            $table->string('specialization')->nullable();
            $table->string('qualification')->nullable();
            $table->date('hire_date')->nullable();
            $table->enum('status', ['active', 'on_leave', 'resigned', 'dismissed', 'missing', 'retired'])->default('active');
            $table->text('address')->nullable();
            $table->string('emergency_contact', 20)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
