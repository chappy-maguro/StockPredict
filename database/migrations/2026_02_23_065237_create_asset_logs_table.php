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
        Schema::create('asset_logs', function (Blueprint $table) {
            $table->id();
            $table->date('date');           // 日付
            $table->string('item');         // 項目
            $table->bigInteger('income')->default(0);    // 収入(+)
            $table->bigInteger('expense')->default(0);   // 支出(▲)
            $table->bigInteger('bank_balance');          // 銀行残高
            $table->bigInteger('total_assets');          // 全資産合計
            $table->text('remarks')->nullable();         // 備考（空でもOK）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_logs');
    }
};
