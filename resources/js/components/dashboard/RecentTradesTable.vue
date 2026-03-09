<script setup lang="ts">
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
}>();

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

            <TableRow>
                <TableCell>10 PM</TableCell>
                <TableCell>SOL-USDT</TableCell>
                <TableCell><Badge variant="success">BUY</Badge></TableCell>
                <TableCell>$142</TableCell>
                <TableCell>$150</TableCell>
                <TableCell>$138</TableCell>
                <TableCell>Strong RSI..</TableCell>
                <TableCell>
                    <Button animation="wiggle" size="sm" variant="destructive">Close Trade</Button>
                </TableCell>
            </TableRow>

            <TableRow>
                <TableCell>9 PM</TableCell>
                <TableCell>BTC-USDT</TableCell>
                <TableCell><Badge variant="destructive">SELL</Badge></TableCell>
                <TableCell>$30,000</TableCell>
                <TableCell>$28,000</TableCell>
                <TableCell>$32,000</TableCell>
                <TableCell>Overbought...</TableCell>
                <TableCell>
                    <Button animation="wiggle" size="sm" variant="destructive">Close Trade</Button>
                </TableCell>
            </TableRow>

            <TableRow>
                <TableCell>8 PM</TableCell>
                <TableCell>ETH-USDT</TableCell>
                <TableCell><Badge variant="accent">HOLD</Badge></TableCell>
                <TableCell>--</TableCell>
                <TableCell>--</TableCell>
                <TableCell>--</TableCell>
                <TableCell>Strong Support...</TableCell>
                <TableCell>
                    <Button animation="wiggle" size="sm" variant="destructive" disabled>Close Trade</Button>
                </TableCell>
            </TableRow>
        </TableBody>
        </Table>
        </CardContent>
    </Card>

</template>
