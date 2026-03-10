<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class ExchangeAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'exchange',
        'environment',
        'api_key',
        'api_secret',
        'api_passphrase',
        'status',
        'last_tested_at',
        'last_connected_at',
        'last_error_message',
        'metadata',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'last_tested_at' => 'datetime',
            'last_connected_at' => 'datetime',
            'api_key' => 'encrypted',
            'api_secret' => 'encrypted',
            'api_passphrase' => 'encrypted',
            'metadata' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function configurations(): HasMany
    {
        return $this->hasMany(TradingConfiguration::class);
    }

    public function signals(): HasMany
    {
        return $this->hasMany(TradeSignal::class);
    }

    public function trades(): HasMany
    {
        return $this->hasMany(Trade::class);
    }

    public static function storeTradeSettingsExchange(string $key, string $secret)
    {
        return self::createOrUpdate([
            'user_id'       => Auth::id(),
            'name'          => 'Lobot',
            'exchange'      => 'Binance',
            'api_key'       => $key,
            'api_secret'    => $secret,
        ]);
    }
}
