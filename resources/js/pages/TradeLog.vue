<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { BreadcrumbItem } from '@/types';
import { tradelogs } from '@/routes';
import PerformanceMetrics from '@/components/tradelogs/PerformanceMetrics.vue';
import RecentTradesTable from '@/components/dashboard/RecentTradesTable.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Trade Log',
        href: tradelogs(),
    },
];

</script>

<template>
    <Head  title="Trade Log" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col overflow-x-auto rounded-xl p-6">
            <h1 class="text-2xl font-bold mb-4">Trade Log</h1>
            <p class="text-muted-foreground mb-6">Review your past trades and analyze your performance over time.</p>

            <div class="relative mb-6">
                <PerformanceMetrics />
            </div>

            <div class="relative mb-6">
                <RecentTradesTable title="Historical and Active Trades" />
            </div>

        </div>
    </AppLayout>

</template>
