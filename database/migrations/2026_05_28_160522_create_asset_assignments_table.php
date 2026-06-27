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
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();
                /*
                * asset 
                */
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')
                  ->references('id')
                  ->on('assets')
                  ->onDelete('cascade');

            /*
             * user assignment
             */
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

             /*
             * department assignment
             */

            $table->unsignedBigInteger('department_id')->nullable();

            $table->foreign('department_id')
                  ->references('id_department')
                  ->on('departments')
                  ->onDelete('cascade');

             /*
             * Assigned by
             */
            $table->unsignedBigInteger('assigned_by');
            $table->foreign('assigned_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

                /*  
                * Assigned at
                */
            $table->dateTime('tanggal_assignment');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->enum('status_assignment', ['pending', 'aktif', 'ditolak', 'selesai']);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('rejected_at')->nullable();

            $table->string('handover_document_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_assignments');
    }
};
