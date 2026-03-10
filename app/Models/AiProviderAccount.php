<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class AiProviderAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'provider',
        'model',
        'base_url',
        'api_key',
        'status',
        'last_tested_at',
        'last_error_message',
        'metadata',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'last_tested_at' => 'datetime',
            'api_key' => 'encrypted',
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

    public static function storeTradeSettingsAi(string $key, string $model)
    {
        return self::updateOrCreate(
            [
                'user_id'   => Auth::id(),
                'provider'  => 'ollama',
            ],
            [
                'name'      => 'ollama',
                'model'     => $model,
                'api_key'   => $key,
                'is_active' => true,
            ]
        );
    }
}
