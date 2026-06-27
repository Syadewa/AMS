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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_asset')->unique();
            $table->string('nama_asset');
            $table->foreignid('kategori_id')
                  ->constrained('asset_categories')
                  ->cascadeOnDelete();
            $table->text('deskripsi')->nullable();
            $table->string('serial_number')->unique();
            $table->date('tanggal_perolehan');
            $table->enum('tipe_asset', ['individual', 'shared']);
            $table->enum('status_asset', ['aktif', 'nonaktif', 'rusak', 'dilepas']);
            $table->string('qr_code_path')->nullable();
            $table->unsignedBigInteger('department_id')
                  ->references('id_departments')
                  ->on('departments')
                  ->onDelete('cascade');
            $table->foreignId('created_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
