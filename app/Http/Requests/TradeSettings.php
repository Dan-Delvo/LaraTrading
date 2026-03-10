<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TradeSettings extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'api_key'               => ['required', 'string', 'max:255'],
            'api_secret'            => ['required', 'string', 'max:255'],
            'risk_reward_ratio'     => ['required', 'string'],
            'max_position_size'     => ['required', 'numeric', 'min:0'],
            'daily_stop_loss_limit' => ['required', 'numeric', 'min:0', 'max:100'],
            'automation_mode'       => ['required', 'in:manual,auto'],
            'ai_api_key'            => ['required', 'string', 'max:255'],
            'active_model'          => ['required', 'string']
        ];
    }
}
