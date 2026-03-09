<script setup lang="ts">
import Card from '../ui/Card.vue';
import CardContent from '../ui/CardContent.vue';
import CardHeader from '../ui/CardHeader.vue';
import CardTitle from '../ui/CardTitle.vue';
import StatCard from '../ui/StatCard.vue';
import { Bot, DollarSign, HandCoins, Percent } from 'lucide-vue-next';

</script>

<template>
    <Card>
        <CardHeader class="bg-accent">
            <CardTitle>Performance Metrics - Last 30 Days</CardTitle>
        </CardHeader>
        <CardContent class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <StatCard title="Win Rate" value="68%" change="+20%" trend="up" color="success" :icon="Percent"/>
            <StatCard title="Total PnL" value="+$450.20 " change="+5%" trend="up" color="info" :icon="HandCoins"/>
            <StatCard title="Active Trades" value="2"  trend="neutral" color="destructive" :icon="Bot"/>
        </CardContent>
    </Card>
</template>
