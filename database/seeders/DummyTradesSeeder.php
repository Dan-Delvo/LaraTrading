<?php

namespace Database\Seeders;

use App\Models\ExchangeAccount;
use App\Models\AiProviderAccount;
use App\Models\Trade;
use App\Models\TradeSignal;
use App\Models\TradingConfiguration;
use Illuminate\Database\Seeder;

class DummyTradesSeeder extends Seeder
{
    public function run(): void
    {
        $userId = 1;

        $exchange = ExchangeAccount::firstWhere('user_id', $userId);
        $ai = AiProviderAccount::firstWhere('user_id', $userId);
        $config = TradingConfiguration::firstWhere('user_id', $userId);

        $symbols = ['SOL-USDT', 'BTC-USDT', 'ETH-USDT'];
        $timeframes = ['5m', '15m', '1h', '4h'];
        $strategies = ['balanced', 'aggressive', 'conservative'];
        $sources = ['manual_ai', 'auto_ai'];

        $trades = [
            // Closed winning trades
            ['symbol' => 'SOL-USDT', 'side' => 'long', 'entry' => 145.50, 'exit' => 158.20, 'sl' => 140.00, 'tp' => 160.00, 'qty' => 0.68, 'status' => 'closed', 'days_ago' => 12],
            ['symbol' => 'BTC-USDT', 'side' => 'long', 'entry' => 67250.00, 'exit' => 69800.00, 'sl' => 66000.00, 'tp' => 70000.00, 'qty' => 0.0015, 'status' => 'closed', 'days_ago' => 10],
            ['symbol' => 'ETH-USDT', 'side' => 'short', 'entry' => 3420.00, 'exit' => 3280.00, 'sl' => 3500.00, 'tp' => 3250.00, 'qty' => 0.03, 'status' => 'closed', 'days_ago' => 9],
            ['symbol' => 'SOL-USDT', 'side' => 'long', 'entry' => 152.30, 'exit' => 161.75, 'sl' => 148.00, 'tp' => 163.00, 'qty' => 0.65, 'status' => 'closed', 'days_ago' => 7],
            ['symbol' => 'BTC-USDT', 'side' => 'short', 'entry' => 71200.00, 'exit' => 69500.00, 'sl' => 72000.00, 'tp' => 69000.00, 'qty' => 0.0014, 'status' => 'closed', 'days_ago' => 6],

            // Closed losing trades
            ['symbol' => 'ETH-USDT', 'side' => 'long', 'entry' => 3380.00, 'exit' => 3310.00, 'sl' => 3300.00, 'tp' => 3500.00, 'qty' => 0.03, 'status' => 'closed', 'days_ago' => 8],
            ['symbol' => 'SOL-USDT', 'side' => 'short', 'entry' => 160.00, 'exit' => 165.50, 'sl' => 166.00, 'tp' => 152.00, 'qty' => 0.62, 'status' => 'closed', 'days_ago' => 5],
            ['symbol' => 'BTC-USDT', 'side' => 'long', 'entry' => 70100.00, 'exit' => 69200.00, 'sl' => 69000.00, 'tp' => 72000.00, 'qty' => 0.0014, 'status' => 'closed', 'days_ago' => 4],

            // Open trades
            ['symbol' => 'SOL-USDT', 'side' => 'long', 'entry' => 155.80, 'exit' => null, 'sl' => 150.00, 'tp' => 168.00, 'qty' => 0.64, 'status' => 'open', 'days_ago' => 1],
            ['symbol' => 'ETH-USDT', 'side' => 'short', 'entry' => 3450.00, 'exit' => null, 'sl' => 3520.00, 'tp' => 3350.00, 'qty' => 0.029, 'status' => 'open', 'days_ago' => 0],

            // Additional closed trades for variety
            ['symbol' => 'SOL-USDT', 'side' => 'long', 'entry' => 138.20, 'exit' => 149.60, 'sl' => 133.00, 'tp' => 150.00, 'qty' => 0.72, 'status' => 'closed', 'days_ago' => 15],
            ['symbol' => 'BTC-USDT', 'side' => 'long', 'entry' => 65800.00, 'exit' => 67400.00, 'sl' => 64500.00, 'tp' => 68000.00, 'qty' => 0.0015, 'status' => 'closed', 'days_ago' => 14],
            ['symbol' => 'ETH-USDT', 'side' => 'long', 'entry' => 3200.00, 'exit' => 3350.00, 'sl' => 3100.00, 'tp' => 3400.00, 'qty' => 0.031, 'status' => 'closed', 'days_ago' => 13],
            ['symbol' => 'SOL-USDT', 'side' => 'short', 'entry' => 148.00, 'exit' => 151.20, 'sl' => 152.00, 'tp' => 140.00, 'qty' => 0.67, 'status' => 'closed', 'days_ago' => 11],
            ['symbol' => 'BTC-USDT', 'side' => 'short', 'entry' => 68500.00, 'exit' => 66900.00, 'sl' => 69500.00, 'tp' => 66000.00, 'qty' => 0.0015, 'status' => 'closed', 'days_ago' => 3],

            // Pending trade
            ['symbol' => 'BTC-USDT', 'side' => 'long', 'entry' => null, 'exit' => null, 'sl' => 68000.00, 'tp' => 74000.00, 'qty' => 0.0014, 'status' => 'pending', 'days_ago' => 0],
        ];

        foreach ($trades as $i => $t) {
            $openedAt = now()->subDays($t['days_ago'])->subHours(rand(1, 12));
            $closedAt = $t['status'] === 'closed' ? $openedAt->copy()->addHours(rand(2, 48)) : null;

            $grossPnl = null;
            $netPnl = null;
            $pnlPercent = null;
            $fees = null;

            if ($t['exit'] !== null && $t['entry'] !== null) {
                $diff = $t['side'] === 'long'
                    ? ($t['exit'] - $t['entry']) * $t['qty']
                    : ($t['entry'] - $t['exit']) * $t['qty'];
                $grossPnl = round($diff, 8);
                $fees = round(abs($grossPnl) * 0.001, 8);
                $netPnl = round($grossPnl - $fees, 8);
                $pnlPercent = round(($netPnl / ($t['entry'] * $t['qty'])) * 100, 2);
            }

            $rr = null;
            if ($t['entry'] !== null && $t['sl'] !== null && $t['tp'] !== null) {
                $risk = abs($t['entry'] - $t['sl']);
                $reward = abs($t['tp'] - $t['entry']);
                $rr = $risk > 0 ? round($reward / $risk, 4) : null;
            }

            $signal = TradeSignal::create([
                'user_id' => $userId,
                'trading_configuration_id' => $config?->id,
                'exchange_account_id' => $exchange?->id,
                'ai_provider_account_id' => $ai?->id,
                'source' => $sources[array_rand($sources)],
                'symbol' => $t['symbol'],
                'timeframe' => $timeframes[array_rand($timeframes)],
                'status' => 'success',
                'action' => $t['side'] === 'long' ? 'buy' : 'sell',
                'ai_strategy' => $strategies[array_rand($strategies)],
                'entry_price' => $t['entry'],
                'take_profit' => $t['tp'],
                'stop_loss' => $t['sl'],
                'risk_reward_ratio' => $rr,
                'risk_per_trade_percent' => rand(50, 200) / 100,
                'recommended_position_size' => $t['entry'] !== null ? round($t['entry'] * $t['qty'], 8) : null,
                'rationale' => $this->rationale($t['symbol'], $t['side']),
                'analysis_time' => rand(2, 8) . 's',
                'analysis_time_seconds' => rand(2, 8),
                'signal_timestamp' => $openedAt->copy()->subMinutes(rand(5, 30)),
            ]);

            Trade::create([
                'user_id' => $userId,
                'trade_signal_id' => $signal->id,
                'exchange_account_id' => $exchange?->id,
                'symbol' => $t['symbol'],
                'side' => $t['side'],
                'status' => $t['status'],
                'quantity' => $t['qty'],
                'entry_price' => $t['entry'],
                'exit_price' => $t['exit'],
                'take_profit' => $t['tp'],
                'stop_loss' => $t['sl'],
                'risk_reward_ratio' => $rr,
                'fees' => $fees,
                'gross_pnl' => $grossPnl,
                'net_pnl' => $netPnl,
                'pnl_percent' => $pnlPercent,
                'opened_at' => $t['status'] !== 'pending' ? $openedAt : null,
                'closed_at' => $closedAt,
                'external_order_id' => $t['status'] !== 'pending' ? 'BIN-' . strtoupper(bin2hex(random_bytes(6))) : null,
            ]);
        }
    }

    private function rationale(string $symbol, string $side): string
    {
        $reasons = [
            "Strong bullish momentum on {$symbol} with RSI divergence and MACD crossover. Volume confirms breakout above resistance.",
            "Bearish engulfing candle on {$symbol} at key resistance. Expecting reversal with declining volume.",
            "{$symbol} consolidating near support with increasing buy volume. Fibonacci 0.618 retracement level holding.",
            "AI detected {$side} opportunity on {$symbol}. Multiple timeframe alignment with trend continuation pattern.",
            "Price action on {$symbol} shows {$side} setup. Bollinger Band squeeze indicating imminent breakout.",
            "{$symbol} forming ascending triangle. AI confidence 85% for {$side} entry with favorable R:R.",
        ];

        return $reasons[array_rand($reasons)];
    }
}
