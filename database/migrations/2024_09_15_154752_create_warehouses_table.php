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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_name', 70);  // Tạo cột warehouse_name với kiểu VARCHAR(70)
            $table->string('address', 255); 
            $table->string('images')->nullable();       // Tạo cột address với kiểu VARCHAR(255)
            $table->string('longitude', );    // Tạo cột longitude với kiểu DECIMAL(9, 6)
            $table->string('latitude', );     // Tạo cột latitude với kiểu DECIMAL(8, 6)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
