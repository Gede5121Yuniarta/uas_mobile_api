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
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('name_kost');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('kost_type', ['campuran', 'laki-laki', 'perempuan'])->default('campuran');
            $table->text('facilities')->nullable(); // Mengubah dari JSON ke text
            $table->text('rules')->nullable(); // Mengubah dari JSON ke text
            $table->text('media')->nullable();
            $table->string('whatsapp_number')->nullable(); // Menambahkan kolom nomor WhatsApp
            $table->string('facebook')->nullable(); // Menambahkan kolom Facebook
            $table->string('instagram')->nullable(); // Menambahkan kolom Instagram
            $table->string('twitter')->nullable(); // Menambahkan kolom Twitter
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};
