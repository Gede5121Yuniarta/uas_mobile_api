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
        Schema::create('room_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kost_id'); // Kolom referensi ke tabel kosts
            $table->unsignedBigInteger('owner_id'); // Kolom referensi ke tabel users
            $table->string('classes_name');
            $table->decimal('price', 10, 2);
            $table->text('facilities')->nullable();
            $table->timestamps();

            $table->foreign('kost_id')->references('id')->on('kosts')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_classes');
    }
};
