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
        Schema::create('stock_price_histories', function (Blueprint $table) {
            $table->id();
            // ここに正解のコードを書きます
            $table->foreignId('simulated_trade_id')->constrained()->cascadeOnDelete();
            $table->decimal('current_price', 12, 2); // 最新の株価
            $table->decimal('profit_loss', 12, 2);   // 計算した損益
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_price_histories');
    }
};
