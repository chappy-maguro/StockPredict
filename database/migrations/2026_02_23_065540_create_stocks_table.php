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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('symbol')->unique(); // 銘柄コード（例: 7203）
            $table->string('name');             // 銘柄名（例: トヨタ自動車）
            $table->string('market');           // 市場（例: 東証プライム）
            $table->string('sector');           // 業種（例: 輸送用機器）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
