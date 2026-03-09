<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { BreadcrumbItem } from '@/types';
import { tradelogs } from '@/routes';

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
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-6 gap-y-6">
            <div class="relative min-h-[75vh] h-[55vh]">
                <h1 class="text-2xl font-bold mb-4">Trade Log</h1>
                <p class="text-muted-foreground mb-6">Review your past trades and analyze your performance over time.</p>
                <div class="overflow-x-auto"></div>
            </div>
        </div>
    </AppLayout>

</template>