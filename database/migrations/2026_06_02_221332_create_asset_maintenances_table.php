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
        Schema::create('asset_maintenances', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id')
                  ->references('id')
                  ->on('assets')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('requested_by');

            $table->foreign('requested_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            
            $table->unsignedBigInteger('handled_by')->nullable();

            $table->foreign('handled_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            $table->text('keluhan');

            $table->text('tindakan')->nullable();

            $table->text('hasil')->nullable();

            $table->enum('status_maintenance', ['pending', 'diproses', 'selesai', 'ditolak']);

            $table->dateTime('tanggal_pengajuan');

            $table->dateTime('tanggal_selesai')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_maintenances');
    }
};
