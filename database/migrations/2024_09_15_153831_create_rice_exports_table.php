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
        Schema::create('rice_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rice_id')->constrained()->nullable();
            $table->integer('quatity'); // số lượng
            $table->decimal('unit_price',10,2);  // Đơn giá
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rice_exports');
    }
};
