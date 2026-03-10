<?php

namespace App\Actions;

use App\Models\AiProviderAccount;
use App\Models\ExchangeAccount;
use App\Models\TradingConfiguration;
use Illuminate\Support\Facades\DB;

class UpdateTradeSettings 
{
    public static function handle(array $validated): void
    {
        DB::transaction(function () use ($validated): void {
            $exchange = ExchangeAccount::storeTradeSettingsExchange(
                $validated['api_key'] ?? null,
                $validated['api_secret'] ?? null
            );
            $ai = AiProviderAccount::storeTradeSettingsAi(
                $validated['ai_api_key'] ?? null, 
                $validated['active_model'] ?? null
            );
            TradingConfiguration::storeTradeSettingsConf(
                $exchange->id, 
                $ai->id, 
                $validated['risk_reward_ratio'],
                $validated['max_position_size'],
                $validated['daily_stop_loss_limit'],
                $validated['automation_mode'],
            );
        }, 3);
    }
}