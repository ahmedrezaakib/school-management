<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixUsersTableStructure extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Change date fields from VARCHAR to proper date types
            $table->date('admission_date')->nullable()->change();
            $table->date('birth_date')->nullable()->change();
            
            // Optimize string lengths
            $table->string('father_name', 100)->nullable()->change();
            $table->string('mother_name', 100)->nullable()->change();
            $table->string('mobile', 20)->nullable()->change();
            
            // Change gender to ENUM for better data integrity
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->change();
            
            // Add foreign key constraints
            $table->foreignId('academic_year_id')->nullable()->change();
            $table->foreign('class_id')->nullable()->change(); 
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes if needed
            $table->dropForeign(['academic_year_id']);
            $table->dropForeign(['class_id']);
            
            $table->string('admission_date', 250)->nullable()->change();
            $table->string('birth_date', 250)->nullable()->change();
            $table->string('gender', 255)->nullable()->change();
        });
    }
}

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Only add columns if they don't already exist
        if (!Schema::hasColumn('users', 'academic_year_id')) {
            $table->unsignedBigInteger('academic_year_id')->nullable();
        }
        if (!Schema::hasColumn('users', 'father_name')) {
            $table->string('father_name')->nullable();
        }
        if (!Schema::hasColumn('users', 'mother_name')) {
            $table->string('mother_name')->nullable();
        }
        if (!Schema::hasColumn('users', 'mobile')) {
            $table->string('mobile')->nullable();
        }
        if (!Schema::hasColumn('users', 'admission_date')) {
            $table->date('admission_date')->nullable();
        }
        if (!Schema::hasColumn('users', 'birth_date')) {
            $table->date('birth_date')->nullable();
        }
        if (!Schema::hasColumn('users', 'gender')) {
            $table->enum('gender', ['male','female'])->nullable();
        }
        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')->default('student');
        }
    });
}


public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['class_id']);
        $table->dropForeign(['academic_year_id']);
        $table->dropColumn([
            'class_id',
            'academic_year_id',
            'father_name',
            'mother_name',
            'mobile',
            'admission_date',
            'birth_date',
            'gender',
            'role'
        ]);
    });
}


};
