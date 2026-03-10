<?php

namespace App\Http\Resources\PagesResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TradeSettingsResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'exchange' => [
                'api_key'               => $this->exchangeAccount?->api_key,
                'api_secret'            => $this->exchangeAccount?->api_secret,
            ],

            'conf' => [
                'risk_reward_ratio'     => $this->default_risk_reward_ratio,
                'max_position_size'     => $this->max_position_size_usdt,
                'daily_stop_loss_limit' => $this->daily_stop_loss_limit_percent,
                'automation_mode'       => $this->automation_mode,
            ],

            'ai' => [
                'ai_api_key'            => $this->aiProviderAccount?->api_key,
                'active_model'          => $this->aiProviderAccount?->model,
            ]
            
        ];
    }
}
