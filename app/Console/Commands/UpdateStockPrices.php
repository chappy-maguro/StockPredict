<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateStockPrices extends Command
{
    protected $signature = 'app:update-stock-prices';
    protected $description = 'Stooq APIを使用して株価を更新し、損益を計算してDBに保存します';

    public function handle()
    {
        // 1. Stooq APIに問い合わせ（トヨタ: 7203.jp）
        $symbol = '7203.jp';
        $this->info("Stooq APIに問い合わせ中: {$symbol}");

        $response = Http::get("https://stooq.com/q/l/", [
            's' => $symbol,
            'f' => 'sd2l1ohcv',
            'e' => 'json',
        ]);

        if (!$response->successful()) {
            $this->error("通信失敗: " . $response->status());
            return;
        }

        $data = $response->json();
        $result = $data['symbols'][0] ?? null;

        // 価格（close）が取れているか確認
        if (!$result || !isset($result['close'])) {
            $this->error("価格データが見つかりませんでした。");
            return;
        }

        $currentPrice = $result['close'];
        $this->info("現在の価格を取得しました: {$currentPrice}円");

        // 2. DBからシミュレーション取引のデータを取得
        $trades = DB::table('simulated_trades')->get();

        if ($trades->isEmpty()) {
            $this->warn("計算対象の取引データ（simulated_trades）が空です。");
            return;
        }

        // 3. 各取引に対して損益を計算して保存
        foreach ($trades as $trade) {
            // 損益計算: (現在値 - 購入価格) * 数量
            $profitLoss = ($currentPrice - $trade->bought_price) * $trade->quantity;

            // stock_price_histories テーブルへ挿入
            DB::table('stock_price_histories')->insert([
                'simulated_trade_id' => $trade->id,
                'current_price'      => $currentPrice,
                'profit_loss'        => $profitLoss,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);

            $this->info("履歴保存完了: ID {$trade->id} (銘柄: {$trade->stock_code}) / 損益: {$profitLoss}円");
        }

        $this->info("すべての処理が正常に終了しました！✨");
    }
}
