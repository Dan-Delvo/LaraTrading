export type Settings = {
    exchange: Exchange,
    conf: Config,
    ai: Ai,
}

export type Exchange = {
    api_key: string | null,
    api_secret: string | null,
}

export type Config = {
    risk_reward_ratio: number | null,
    max_position_size: number | null,
    daily_stop_loss_limit: number | null,
    automation_mode: 'manual' | 'auto' | null,
}

export type Ai = {
    ai_api_key: string | null,
    active_model: string | null,
}
