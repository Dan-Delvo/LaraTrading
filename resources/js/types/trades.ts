export type Trades = {
    id: number;
    opened_at: string;
    symbol: string;
    action: string;
    entry_price: number;
    take_profit: number;
    stop_loss: number;
    rationale: string;
    status: string;
}

export type Paginated<T> = {
    data: T[];
    links: {
        first: string | null;
        last: string | null;
        prev: string | null;
        next: string | null;
    };
    meta: {
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
        links: {
            url: string | null;
            label: string;
            page: number | null;
            active: boolean;
        }[];
    };
};