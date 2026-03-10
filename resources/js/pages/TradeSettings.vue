<script setup lang="ts">
import { Button } from '@/components/ui/button';
import Card from '@/components/ui/Card.vue';
import CardContent from '@/components/ui/CardContent.vue';
import CardHeader from '@/components/ui/CardHeader.vue';
import CardTitle from '@/components/ui/CardTitle.vue';
import Input from '@/components/ui/Input.vue';
import Sticker from '@/components/ui/Sticker.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import RadioGroup from '@/components/ui/RadioGroup.vue';
import RadioGroupItem from '@/components/ui/RadioGroupItem.vue';
import tradesettings from '@/routes/tradesettings';
import { Settings } from '@/types/settings';
import { toast } from 'vue-sonner';

const breadcrumbs: BreadcrumbItem[] =[
    {
        title: 'Settings',
        href: tradesettings.index()
    },
];

const props = defineProps<{
    settings: Settings | null
}>();

const form = useForm({
    api_key: props.settings?.exchange?.api_key || '',
    api_secret: props.settings?.exchange?.api_secret || '',
    risk_reward_ratio: props.settings?.conf?.risk_reward_ratio || 0,
    max_position_size: props.settings?.conf?.max_position_size || 0,
    daily_stop_loss_limit: props.settings?.conf?.daily_stop_loss_limit || 0,
    automation_mode: props.settings?.conf?.automation_mode || 'manual',
    ai_api_key: props.settings?.ai?.ai_api_key || '',
    active_model: props.settings?.ai?.active_model || '',
});

const submit = () => {
    const r = tradesettings.store();
    form.post(r.url, {
        preserveScroll: true,
        onSuccess: () => {
            toast.error('Settings saved successfully!');
        },
        onError: () => {
            toast.error('Failed to save settings. Please try again.');
        },
    });
};

</script>

<template>
    <Head title="Settings" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <form class="flex h-full flex-1 flex-col overflow-x-auto rounded-xl p-6 " @submit.prevent="submit">
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
                            <Input v-model="form.api_key" type="password" placeholder="Enter API key" />
                        </div>
                        <div class="flex flex-row items-center gap-3">
                            <CardTitle class="whitespace-nowrap font-mono">API Secret: </CardTitle>
                            <Input v-model="form.api_secret" type="password" placeholder="Enter API Secret" />
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
                            <Select v-model="form.risk_reward_ratio">
                                <SelectTrigger
                                    class="h-11 w-full border-3 border-foreground bg-background font-bold shadow-[4px_4px_0px_hsl(var(--shadow-color))] focus:translate-x-[4px] focus:translate-y-[4px] focus:shadow-none"
                                >
                                <SelectValue placeholder="Select a Default Risk/Reward" />
                                </SelectTrigger>
                                    <SelectContent class="z-[9999] border-3 border-foreground bg-card shadow-[4px_4px_0px_hsl(var(--shadow-color))]">
                                    <SelectItem value="1.00" class="font-semibold">1</SelectItem>
                                    <SelectItem value="1.50" class="font-semibold">1.5</SelectItem>
                                    <SelectItem value="2.00" class="font-semibold">2</SelectItem>
                                    <SelectItem value="3.00" class="font-semibold">3</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>

                        <div class="flex flex-row items-center gap-3">
                            <CardTitle class="whitespace-nowrap font-mono">Max Position Size (USDT): </CardTitle>
                            <Input v-model="form.max_position_size" type="number" placeholder="Enter Amount" />
                        </div>

                        <div class="flex flex-row items-center gap-3">
                            <CardTitle class="whitespace-nowrap font-mono">Daily Stop Loss Limit (%): </CardTitle>
                            <Input v-model="form.daily_stop_loss_limit" type="number" placeholder="Enter Percentage" />
                        </div>

                        <CardTitle class="whitespace-nowrap font-mono">automation Mode:</CardTitle>

                        <RadioGroup v-model="form.automation_mode" className="flex gap-4">
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
                            <Input v-model="form.ai_api_key" type="password" placeholder="Enter API Key" />
                        </div>
                        <div class="flex flex-row items-center gap-3">
                        <CardTitle class="whitespace-nowrap font-mono">Active Model: </CardTitle>
                            <Select v-model="form.active_model">
                                <SelectTrigger
                                    class="h-11 w-full border-3 border-foreground bg-background font-bold shadow-[4px_4px_0px_hsl(var(--shadow-color))] focus:translate-x-[4px] focus:translate-y-[4px] focus:shadow-none"
                                >
                                <SelectValue placeholder="Select a model" />
                                </SelectTrigger>
                                    <SelectContent class="z-[9999] border-3 border-foreground bg-card shadow-[4px_4px_0px_hsl(var(--shadow-color))]">
                                    <SelectItem value="ollama" class="font-semibold">Ollama</SelectItem>
                                    <SelectItem value="gpt-4.1-mini" class="font-semibold">gpt-4.1-mini</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                    </CardContent>
                </Card>
            </div>

            <div class="flex flex-row justify-end mt-6">
                <Button type="submit" variant="default" :disabled="form.processing">Save Settings</Button>
            </div>
            
        </form>
    </AppLayout>

</template>
