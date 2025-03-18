<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('room_images', function (Blueprint $table) {
            $table->id();
            $table->uuid('rooms_id'); // Sesuai dengan ID room
            $table->string('image_path'); // Path gambar
            $table->timestamps();

            // Foreign key untuk menghubungkan ke tabel rooms
            $table->foreign('rooms_id')->references('rooms_id')->on('rooms')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_images');
    }
};
