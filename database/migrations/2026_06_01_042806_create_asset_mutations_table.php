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
        Schema::create('asset_mutations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('asset_id');

            $table->foreign('asset_id')
                  ->references('id')
                  ->on('assets')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('from_user_id')->nullable();

            $table->foreign('from_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->unsignedBigInteger('from_department_id')->nullable();

            $table->foreign('from_department_id')
                  ->references('id_department')
                  ->on('departments')
                  ->onDelete('set null');

            $table->unsignedBigInteger('to_user_id')->nullable();

            $table->foreign('to_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->unsignedBigInteger('to_department_id')->nullable();

            $table->foreign('to_department_id')
                  ->references('id_department')
                  ->on('departments')
                  ->onDelete('set null');

        
            $table->unsignedBigInteger('requested_by');

            $table->foreign('requested_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->dateTime('tanggal_mutasi');
            $table->enum('status_mutasi', ['pending', 'disetujui', 'ditolak']);
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->string('dokumen_mutasi')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_mutations');
    }
};
