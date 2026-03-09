<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import Chart from '@/components/dashboard/Chart.vue';
import RecentTradesTable from '@/components/dashboard/RecentTradesTable.vue';
import AiControlPanel from '@/components/dashboard/AiControlPanel.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
    },
];

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col overflow-x-auto rounded-xl p-6 ">
            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
            <p class="text-muted-foreground mb-6">Get an overview of your trading performance, recent activity, and insights powered by A.I.</p>
            <div class="relative mb-6">
                <AiControlPanel />
            </div>

            <div class="relative min-h-[75vh] h-[55vh] mb-6">
                <Chart />
            </div>

            <div class="relative">
                <RecentTradesTable />
            </div>

        </div>
    </AppLayout>
</template>
