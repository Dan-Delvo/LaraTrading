<?php

namespace App\Http\Resources\PagesResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TradeLogsResource extends JsonResource
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
            'id'            => $this->id,
            'opened_at'     => $this->opened_at,
            'symbol'        => $this->symbol,
            'action'        => $this->tradeSignal?->action,
            'entry_price'   => $this->entry_price,
            'take_profit'   => $this->take_profit,
            'stop_loss'     => $this->stop_loss,
            'rationale'     => $this->tradeSignal?->rationale,
            'status'        => $this->status
        ];
    }
}
