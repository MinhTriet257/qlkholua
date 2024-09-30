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
            $table->string('address', 255);        // Tạo cột address với kiểu VARCHAR(255)
            $table->decimal('longitude', 9, 6);    // Tạo cột longitude với kiểu DECIMAL(9, 6)
            $table->decimal('latitude', 8, 6);     // Tạo cột latitude với kiểu DECIMAL(8, 6)
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
