<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete(); // role=teacher
            $table->unsignedTinyInteger('day_of_week'); // 0=Sun,1=Mon,...6=Sat
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room')->nullable();
            $table->foreignId('academic_year_id')->nullable()->constrained('academic_years')->nullOnDelete();
            $table->timestamps();

            $table->index(['class_id','day_of_week','start_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
