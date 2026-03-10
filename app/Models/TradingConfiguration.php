<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class TradingConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exchange_account_id',
        'ai_provider_account_id',
        'name',
        'default_symbol',
        'default_timeframe',
        'automation_mode',
        'default_ai_strategy',
        'default_risk_reward_ratio',
        'default_risk_per_trade_percent',
        'max_position_size_usdt',
        'daily_stop_loss_limit_percent',
        'daily_loss_limit_usdt',
        'max_leverage',
        'max_open_positions',
        'allow_long_trades',
        'allow_short_trades',
        'is_active',
        'rules',
    ];

    protected function casts(): array
    {
        return [
            'default_risk_reward_ratio' => 'decimal:2',
            'default_risk_per_trade_percent' => 'decimal:2',
            'max_position_size_usdt' => 'decimal:8',
            'daily_stop_loss_limit_percent' => 'decimal:2',
            'daily_loss_limit_usdt' => 'decimal:8',
            'max_leverage' => 'decimal:2',
            'allow_long_trades' => 'boolean',
            'allow_short_trades' => 'boolean',
            'is_active' => 'boolean',
            'rules' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exchangeAccount(): BelongsTo
    {
        return $this->belongsTo(ExchangeAccount::class);
    }

    public function aiProviderAccount(): BelongsTo
    {
        return $this->belongsTo(AiProviderAccount::class);
    }

    public function signals(): HasMany
    {
        return $this->hasMany(TradeSignal::class);
    }

    public static function storeTradeSettingsConf(
        ?int $exchangeId,
        ?int $aiId,
        ?string $rr,
        ?int $maxSize,
        ?int $dailySl,
        string $mode
    ): self {
        return self::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'name' => 'Default Configuration',
            ],
            [
                'exchange_account_id' => $exchangeId,
                'ai_provider_account_id' => $aiId,
                'default_symbol' => 'SOL-USDT',
                'default_timeframe' => null,
                'automation_mode' => $mode,
                'default_ai_strategy' => 'balanced',
                'default_risk_reward_ratio' => $rr,
                'default_risk_per_trade_percent' => null,
                'max_position_size_usdt' => $maxSize,
                'daily_stop_loss_limit_percent' => $dailySl,
                'daily_loss_limit_usdt' => null,
                'max_leverage' => null,
                'max_open_positions' => 1,
                'allow_long_trades' => true,
                'allow_short_trades' => true,
                'is_active' => true,
                'rules' => null,
            ]
        );
    }
}
