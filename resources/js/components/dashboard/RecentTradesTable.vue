<script setup lang="ts">
import { Trades } from '@/types/trades';
import Badge from '../ui/Badge.vue';
import { Button } from '../ui/button';
import Card from '../ui/Card.vue';
import CardContent from '../ui/CardContent.vue';
import CardHeader from '../ui/CardHeader.vue';
import CardTitle from '../ui/CardTitle.vue';
import Table from '../ui/Table.vue';
import TableBody from '../ui/TableBody.vue';
import TableCell from '../ui/TableCell.vue';
import TableHead from '../ui/TableHead.vue';
import TableHeader from '../ui/TableHeader.vue';
import TableRow from '../ui/TableRow.vue';

const props = defineProps<{
    title: string;
    trades: Trades[];
}>();

const formatTradeDateTime = (value: string) => {
    return new Intl.DateTimeFormat(undefined, {
        month: 'short',
        day: 'numeric',
        year: 'numeric',
        hour: 'numeric',
        minute: '2-digit',
    }).format(new Date(value));
};

const formatPrice = (value: number | string) => {
    return Number(value).toFixed(2);
};

</script>

<template>

    <Card>
        <CardHeader class="bg-secondary">
        <CardTitle>{{ props.title }}</CardTitle>
        </CardHeader>
        <CardContent>
        <Table>
        <TableHeader>
            <TableRow>
            <TableHead>Time</TableHead>
            <TableHead>Asset</TableHead>
            <TableHead>Action</TableHead>
            <TableHead>Entry</TableHead>
            <TableHead>TP</TableHead>
            <TableHead>SL</TableHead>
            <TableHead>A.I. Rationale</TableHead>
            <TableHead>Manual</TableHead>
            </TableRow>
        </TableHeader>
        <TableBody>
            <TableRow v-for="trade in props.trades" :key="trade.id">
                <TableCell>{{ formatTradeDateTime(trade.opened_at) }}</TableCell>
                <TableCell>{{ trade.symbol }}</TableCell>
                <TableCell><Badge :variant="trade.action === 'buy' ? 'success' : trade.action === 'sell' ? 'destructive' : 'accent'">{{ trade.action.toUpperCase() }}</Badge></TableCell>
                <TableCell>{{ formatPrice(trade.entry_price) }}</TableCell>
                <TableCell>{{ formatPrice(trade.take_profit) }}</TableCell>
                <TableCell>{{ formatPrice(trade.stop_loss) }}</TableCell>
                <TableCell>{{ trade.rationale }}</TableCell>
                <TableCell>
                    <Button :disabled="trade.status !== 'open'" animation="wiggle" size="sm" variant="destructive">Close Trade</Button>
                </TableCell>
            </TableRow>
        </TableBody>
        </Table>
        </CardContent>
    </Card>

</template>
