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
        Schema::create('stock_prices', function (Blueprint $table) {
            $table->id();
            // stocksテーブルのidと紐付ける（外部キー）
            $table->foreignId('stock_id')->constrained()->cascadeOnDelete();
            $table->date('date');           // 日付
            $table->decimal('open', 15, 2);  // 始値
            $table->decimal('high', 15, 2);  // 高値
            $table->decimal('low', 15, 2);   // 安値
            $table->decimal('close', 15, 2); // 終値
            $table->bigInteger('volume');    // 出来高
            $table->timestamps();
            // 同じ銘柄で同じ日付のデータが重複しないように制約をかける
            $table->unique(['stock_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_prices');
    }
};
