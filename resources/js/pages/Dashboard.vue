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
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-6 gap-y-6">

            <div class="relative">
                <AiControlPanel />
            </div>

            <div class="relative min-h-[75vh] h-[55vh]">
                <Chart />
            </div>

            <div class="relative">
                <RecentTradesTable />
            </div>

        </div>
    </AppLayout>
</template>
