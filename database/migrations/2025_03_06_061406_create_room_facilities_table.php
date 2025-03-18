<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('room_facilities', function (Blueprint $table) {
            $table->id();
            $table->uuid('rooms_id'); // Tipe data harus UUID!
            $table->string('facility_name');
            $table->timestamps();
        
            $table->foreign('rooms_id')->references('rooms_id')->on('rooms')->onDelete('cascade');
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('room_facilities');
    }
};

