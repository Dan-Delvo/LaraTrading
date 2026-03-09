<script setup lang="ts">
import { Button } from '@/components/ui/button';
import Card from '@/components/ui/Card.vue';
import CardContent from '@/components/ui/CardContent.vue';
import CardHeader from '@/components/ui/CardHeader.vue';
import CardTitle from '@/components/ui/CardTitle.vue';
import Input from '@/components/ui/Input.vue';
import Sticker from '@/components/ui/Sticker.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { tradesettings } from '@/routes';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import RadioGroup from '@/components/ui/RadioGroup.vue';
import RadioGroupItem from '@/components/ui/RadioGroupItem.vue';

const breadcrumbs: BreadcrumbItem[] =[
    {
        title: 'Settings',
        href: tradesettings()
    },
];
</script>

<template>
    <Head title="Settings" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col overflow-x-auto rounded-xl p-6 ">
            <h1 class="text-2xl font-bold mb-4">Settings</h1>

            <div class="relative mb-6">
                <Card>
                    <CardHeader class="bg-accent">
                        <CardTitle>Exchange API (BINANCE)</CardTitle>
                    </CardHeader>
                    <CardContent class="flex flex-col gap-4">
                        <p class="font-mono">Connect your exchange to allow the AI to execute trades.</p>
                        <div class="flex flex-row items-center gap-3">
                            <CardTitle class="whitespace-nowrap font-mono">API Key: </CardTitle>
                            <Input type="password" placeholder="Enter API key" />
                        </div>
                        <div class="flex flex-row items-center gap-3">
                            <CardTitle class="whitespace-nowrap font-mono">API Secret: </CardTitle>
                            <Input type="password" placeholder="Enter API Secret" />
                        </div>
                        <div class="flex flex-row justify-between">
                            <div>
                                <Button variant="default" >Test Connection</Button>
                            </div>
                            <div class="flex flex-row gap-4 justify-center items-center">
                                <CardTitle class="font-mono">Status: </CardTitle>
                                <Sticker tape variant="destructive" rotation="medium-right">Disconnected</Sticker>
                            </div>
                        </div>
                    </CardContent>
                </Card>
            </div>
            <div class="relative mb-6">
                <Card>
                    <CardHeader class="bg-info">
                        <CardTitle>DEFAULT TRADING PARAMETERS</CardTitle>
                    </CardHeader>
                    <CardContent class="flex flex-col gap-4">
                        <p class="font-mono">Set the base rules the AI must follow for position sizing.</p>
                        <div class="flex flex-row items-center gap-3">
                        <CardTitle class="whitespace-nowrap font-mono">Default Risk/Reward Ratio: </CardTitle>
                            <Select>
                                <SelectTrigger
                                    class="h-11 w-full border-3 border-foreground bg-background font-bold shadow-[4px_4px_0px_hsl(var(--shadow-color))] focus:translate-x-[4px] focus:translate-y-[4px] focus:shadow-none"
                                >
                                <SelectValue placeholder="Select a ticker" />
                                </SelectTrigger>
                                    <SelectContent class="z-[9999] border-3 border-foreground bg-card shadow-[4px_4px_0px_hsl(var(--shadow-color))]">
                                    <SelectItem value="apple" class="font-semibold">SOL-USDT</SelectItem>
                                    <SelectItem value="banana" class="font-semibold">BTC-USDT</SelectItem>
                                    <SelectItem value="orange" class="font-semibold">ETH-USDT</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>

                        <div class="flex flex-row items-center gap-3">
                            <CardTitle class="whitespace-nowrap font-mono">Max Position Size (USDT): </CardTitle>
                            <Input type="number" placeholder="Enter Amount" />
                        </div>

                        <div class="flex flex-row items-center gap-3">
                            <CardTitle class="whitespace-nowrap font-mono">Daily Stop Loss Limit (%): </CardTitle>
                            <Input type="number" placeholder="Enter Percentage" />
                        </div>

                        <CardTitle class="whitespace-nowrap font-mono">automation Mode:</CardTitle>

                        <RadioGroup defaultValue="manual" className="flex gap-4">
                            <div class="flex items-start space-x-2 mb-2">
                                <RadioGroupItem value="manual" id="manual" class="mt-1" />
                                <div class="grid gap-1.5 leading-none">
                                <Label htmlFor="manual" class="font-mono font-bold">Manual</Label>
                                <p class="text-sm text-muted-foreground font-mono">
                                    Manual execution.
                                </p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-2">
                                <RadioGroupItem value="auto" id="auto" class="mt-1" />
                                <div class="grid gap-1.5 leading-none">
                                <Label htmlFor="auto" class="font-mono font-bold">Auto</Label>
                                <p class="text-sm text-muted-foreground font-mono">
                                    AI Executes to Exchange.
                                </p>
                                </div>
                            </div>
                        </RadioGroup>
                    </CardContent>
                </Card>
            </div>

            <div class="relative">
                <Card>
                    <CardHeader class="bg-primary">
                        <CardTitle>System Engine</CardTitle>
                    </CardHeader>
                    <CardContent class="flex flex-col gap-4">
                        <div class="flex flex-row items-center gap-3">
                            <CardTitle class="whitespace-nowrap font-mono">AI API Key: </CardTitle>
                            <Input type="password" placeholder="Enter API Key" />
                        </div>
                        <div class="flex flex-row items-center gap-3">
                        <CardTitle class="whitespace-nowrap font-mono">Active Model: </CardTitle>
                            <Select>
                                <SelectTrigger
                                    class="h-11 w-full border-3 border-foreground bg-background font-bold shadow-[4px_4px_0px_hsl(var(--shadow-color))] focus:translate-x-[4px] focus:translate-y-[4px] focus:shadow-none"
                                >
                                <SelectValue placeholder="Select a ticker" />
                                </SelectTrigger>
                                    <SelectContent class="z-[9999] border-3 border-foreground bg-card shadow-[4px_4px_0px_hsl(var(--shadow-color))]">
                                    <SelectItem value="apple" class="font-semibold">SOL-USDT</SelectItem>
                                    <SelectItem value="banana" class="font-semibold">BTC-USDT</SelectItem>
                                    <SelectItem value="orange" class="font-semibold">ETH-USDT</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>

</template>
