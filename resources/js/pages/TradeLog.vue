<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { BreadcrumbItem } from '@/types';
import PerformanceMetrics from '@/components/tradelogs/PerformanceMetrics.vue';
import RecentTradesTable from '@/components/dashboard/RecentTradesTable.vue';
import Pagination from '@/components/ui/Pagination.vue';
import PaginationContent from '@/components/ui/PaginationContent.vue';
import PaginationEllipsis from '@/components/ui/PaginationEllipsis.vue';
import PaginationItem from '@/components/ui/PaginationItem.vue';
import PaginationLink from '@/components/ui/PaginationLink.vue';
import PaginationNext from '@/components/ui/PaginationNext.vue';
import PaginationPrevious from '@/components/ui/PaginationPrevious.vue';
import { Paginated, Trades } from '@/types/trades';
import tradelogs from '@/routes/tradelogs';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Trade Log',
        href: tradelogs.index(),
    },
];

const props = defineProps<{
    trades: Paginated<Trades>;
}>();

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
                <RecentTradesTable title="Historical and Active Trades" :trades="props.trades?.data ?? []" />
            </div>

            <Pagination v-if="props.trades?.meta?.links?.length > 3" class="mt-2">
                <PaginationContent>
                    <PaginationItem v-for="(link, index) in props.trades.meta.links" :key="index">
                        <PaginationPrevious
                            v-if="link.label.includes('Previous')"
                            :href="link.url ?? undefined"
                            :only="['trades']"
                            :preserve-scroll="true"
                            :preserve-state="true"
                            :class="!link.url ? 'pointer-events-none opacity-50' : undefined"
                        />

                        <PaginationNext
                            v-else-if="link.label.includes('Next')"
                            :href="link.url ?? undefined"
                            :only="['trades']"
                            :preserve-scroll="true"
                            :preserve-state="true"
                            :class="!link.url ? 'pointer-events-none opacity-50' : undefined"
                        />

                        <PaginationEllipsis v-else-if="link.label === '...'" />

                        <PaginationLink
                            v-else
                            :href="link.url ?? undefined"
                            :is-active="link.active"
                            :only="['trades']"
                            :preserve-scroll="true"
                            :preserve-state="true"
                            :class="!link.url ? 'pointer-events-none opacity-50' : undefined"
                        >
                            {{ link.label }}
                        </PaginationLink>
                    </PaginationItem>
                </PaginationContent>
            </Pagination>

        </div>
    </AppLayout>

</template>
