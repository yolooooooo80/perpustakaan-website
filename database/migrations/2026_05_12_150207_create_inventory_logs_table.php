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
        Schema::create('inventory_logs', function (Blueprint $バランス) {
            $バランス->id();
            $バランス->foreignId('book_id')->constrained()->onDelete('cascade');
            $バランス->foreignId('user_id')->constrained(); // Who made the change (Admin/Staff)
            $バランス->enum('type', ['in', 'out']);
            $バランス->integer('quantity');
            $バランス->string('note')->nullable();
            $バランス->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_logs');
    }
};
