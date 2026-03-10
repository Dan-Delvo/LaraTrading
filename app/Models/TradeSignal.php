<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TradeSignal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trading_configuration_id',
        'exchange_account_id',
        'ai_provider_account_id',
        'source',
        'symbol',
        'timeframe',
        'status',
        'action',
        'ai_strategy',
        'entry_price',
        'take_profit',
        'stop_loss',
        'risk_reward_ratio',
        'risk_per_trade_percent',
        'recommended_position_size',
        'rationale',
        'analysis_time',
        'analysis_time_seconds',
        'signal_timestamp',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'entry_price' => 'decimal:8',
            'take_profit' => 'decimal:8',
            'stop_loss' => 'decimal:8',
            'risk_reward_ratio' => 'decimal:4',
            'risk_per_trade_percent' => 'decimal:2',
            'recommended_position_size' => 'decimal:8',
            'signal_timestamp' => 'datetime',
            'payload' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tradingConfiguration(): BelongsTo
    {
        return $this->belongsTo(TradingConfiguration::class);
    }

    public function exchangeAccount(): BelongsTo
    {
        return $this->belongsTo(ExchangeAccount::class);
    }

    public function aiProviderAccount(): BelongsTo
    {
        return $this->belongsTo(AiProviderAccount::class);
    }

    public function trade(): HasOne
    {
        return $this->hasOne(Trade::class);
    }
}
