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
        Schema::create('export_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->nullable();
            $table->foreignId('employee_id')->constrained()->nullable();
            $table->foreignId('warehouse_id')->constrained()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_receipts');
    }
};
