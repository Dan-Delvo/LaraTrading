<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trade_signal_id',
        'exchange_account_id',
        'symbol',
        'side',
        'status',
        'quantity',
        'entry_price',
        'exit_price',
        'take_profit',
        'stop_loss',
        'risk_reward_ratio',
        'fees',
        'gross_pnl',
        'net_pnl',
        'pnl_percent',
        'opened_at',
        'closed_at',
        'external_order_id',
        'notes',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:8',
            'entry_price' => 'decimal:8',
            'exit_price' => 'decimal:8',
            'take_profit' => 'decimal:8',
            'stop_loss' => 'decimal:8',
            'risk_reward_ratio' => 'decimal:4',
            'fees' => 'decimal:8',
            'gross_pnl' => 'decimal:8',
            'net_pnl' => 'decimal:8',
            'pnl_percent' => 'decimal:2',
            'opened_at' => 'datetime',
            'closed_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tradeSignal(): BelongsTo
    {
        return $this->belongsTo(TradeSignal::class);
    }

    public function exchangeAccount(): BelongsTo
    {
        return $this->belongsTo(ExchangeAccount::class);
    }

    public static function getTradesForTable(): ?LengthAwarePaginator
    {
        return self::query()
            ->select([
                'id',
                'trade_signal_id',
                'exchange_account_id',
                'opened_at',
                'symbol',
                'entry_price',
                'take_profit',
                'stop_loss',
                'status'
            ])
            ->where('user_id', Auth::id())
            ->with([
                'tradeSignal:id,action,rationale'
            ])
            ->paginate(5);
    }
}
