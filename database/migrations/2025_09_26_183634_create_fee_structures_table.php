<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('fee_structures')) {
            Schema::create('fee_structures', function (Blueprint $table) {
                $table->id();
                
                $table->foreignId('student_id')->nullable()->constrained('users')->onDelete('cascade');
                $table->foreignId('class_id')->constrained()->onDelete('cascade');
                $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');
                $table->foreignId('fee_head_id')->constrained()->onDelete('cascade');
                $table->string('January')->nullable();
                $table->string('Fabruary')->nullable();
                $table->string('March')->nullable();
                $table->string('April')->nullable();
                $table->string('May')->nullable();
                $table->string('June')->nullable();
                $table->string('July')->nullable();
                $table->string('August')->nullable();
                $table->string('September')->nullable();
                $table->string('October')->nullable();
                $table->string('November')->nullable();
                $table->string('December')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
