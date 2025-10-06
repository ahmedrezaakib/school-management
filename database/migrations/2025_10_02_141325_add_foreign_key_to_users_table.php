<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToUsersTable extends Migration
{
    public function up()
    {
        // Make sure the academic_years table exists first
        if (Schema::hasTable('academic_years')) {
            Schema::table('users', function (Blueprint $table) {
                // Add foreign key constraint
                $table->foreign('academic_year_id')
                      ->references('id')
                      ->on('academic_years')
                      ->onDelete('restrict') // or 'cascade', 'set null'
                      ->onUpdate('cascade');
            });
        }
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['academic_year_id']);
        });
    }
}