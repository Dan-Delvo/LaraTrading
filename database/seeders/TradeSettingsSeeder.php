<?php

namespace Database\Seeders;

use App\Models\AiProviderAccount;
use App\Models\ExchangeAccount;
use App\Models\TradingConfiguration;
use App\Models\User;
use Illuminate\Database\Seeder;

class TradeSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $exchange = ExchangeAccount::updateOrCreate(
            ['user_id' => $user->id, 'exchange' => 'binance'],
            [
                'name' => 'Primary Exchange',
                'environment' => 'testnet',
                'api_key' => 'demo_binance_api_key_123',
                'api_secret' => 'demo_binance_api_secret_456',
                'status' => 'connected',
                'is_active' => true,
            ]
        );

        $ai = AiProviderAccount::updateOrCreate(
            ['user_id' => $user->id, 'provider' => 'openai'],
            [
                'name' => 'Primary AI Provider',
                'model' => 'gpt-4.1-mini',
                'api_key' => 'demo_openai_api_key_789',
                'status' => 'connected',
                'is_active' => true,
            ]
        );

        TradingConfiguration::updateOrCreate(
            ['user_id' => $user->id, 'name' => 'Default Configuration'],
            [
                'exchange_account_id' => $exchange->id,
                'ai_provider_account_id' => $ai->id,
                'default_symbol' => 'SOL-USDT',
                'default_timeframe' => '1h',
                'automation_mode' => 'manual',
                'default_ai_strategy' => 'balanced',
                'default_risk_reward_ratio' => 2.00,
                'default_risk_per_trade_percent' => 1.00,
                'max_position_size_usdt' => 100.00,
                'daily_stop_loss_limit_percent' => 5.00,
                'daily_loss_limit_usdt' => 50.00,
                'max_leverage' => 5.00,
                'max_open_positions' => 3,
                'allow_long_trades' => true,
                'allow_short_trades' => true,
                'is_active' => true,
            ]
        );
    }
}
