<?php

use App\Models\Discount;
use App\Models\Order;
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
        Schema::create('discount_order', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Discount::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Order::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_order');
    }
};
