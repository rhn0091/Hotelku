<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->uuid('reservation_id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->uuid('rooms_id');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('total_rooms');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        
            // Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rooms_id')->references('rooms_id')->on('rooms')->onDelete('cascade');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
