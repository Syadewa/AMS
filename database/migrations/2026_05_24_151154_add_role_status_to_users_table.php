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

        $table->enum('role', ['admin','manager','user'])
              ->default('user');
        
        $table->enum('status', ['aktif','nonaktif'])
              ->default('aktif');
        
        $table->boolean('must_change_password')
              ->default(true);
        
        $table->foreignId('department_id')
              ->nullable()
              ->constrained('departments', 'id_department')
              ->onDelete('set null');
             //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            
        $table->dropColumn(['role', 
        'status', 
        'must_change_password',
        'department_id']);
            //
        });
    }
};
