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
        Schema::create('asset_disposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->unique();
            $table->foreign('asset_id')
                  ->references('id')
                  ->on('assets')
                  ->onDelete('cascade');
            $table->enum('jenis_pelepasan', ['dijual', 'dihibahkan', 'dimusnahkan']);
            $table->text('alasan');
            $table->enum('status_approval', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->string('berita_acara_path')->nullable();
            $table->unsignedBigInteger('requested_by');
            $table->foreign('requested_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
            $table->dateTime('tanggal_pengajuan');
            $table->dateTime('approved_at')->nullable();
            $table->text('notes')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_disposals');
    }
};
