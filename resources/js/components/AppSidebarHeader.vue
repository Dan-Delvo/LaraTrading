<script setup lang="ts">
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItem } from '@/types';
import Sticker from '@/components/ui/Sticker.vue';
import { Separator } from '@/components/ui/separator';
withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItem[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header
        class="bg-background/95 flex h-16 shrink-0 items-center gap-2 border-b-3 border-foreground px-6 shadow-[0_4px_0px_hsl(var(--shadow-color))] transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4"
    >
        <div class="flex h-full w-full items-center justify-between">
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1" />
            <Breadcrumbs v-if="breadcrumbs?.length" :breadcrumbs="breadcrumbs" />
        </div>

        <div class="flex items-center gap-2">
            <Separator orientation="vertical" class="h-6 w-[3px] bg-foreground" />
            <div class="font-bold">Binance API : <Sticker variant="destructive" rotation="none">Disconnected</Sticker></div>
            <Separator orientation="vertical" class="h-6 w-[3px] bg-foreground" />
            <div class="font-bold">Wallet Balance : <Sticker rotation="none">$0</Sticker></div>
        </div>
        </div>
    </header>
</template>
