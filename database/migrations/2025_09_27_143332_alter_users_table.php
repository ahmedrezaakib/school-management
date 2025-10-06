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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('class_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('academic_year_id')->nullable()->constrained()->onDelete('cascade')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('number')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'class_id',
                'academic_year_id',
                'admission_date',
                'father_name',
                'mother_name',
                'number',
                'birth_date',
                'gender',
                'blood',
            ]);
        });
    }
};
