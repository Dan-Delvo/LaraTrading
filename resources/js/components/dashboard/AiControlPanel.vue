<script setup lang="ts">
import { Button } from '../ui/button';
import Card from '../ui/Card.vue';
import CardContent from '../ui/CardContent.vue';
import CardFooter from '../ui/CardFooter.vue';
import CardHeader from '../ui/CardHeader.vue';
import CardTitle from '../ui/CardTitle.vue';
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select';
import StatCard from '../ui/StatCard.vue';
import { DollarSign } from 'lucide-vue-next';


</script>

<template>
    
    <Card>
        <CardHeader class="bg-info">
        <CardTitle>A.I. Control Panel</CardTitle>
        </CardHeader>
        <CardContent class="grid grid-cols-1 md:grid-cols-2 gap-6 ">
            <Card class="flex flex-col h-full">
                <CardHeader>
                <CardTitle>Create a trade analysis</CardTitle>
                </CardHeader>
                <CardContent class="flex-1 h-fit">
                    <h2 class="text-lg font-semibold mb-4">Configuration</h2>
                    <p class="mb-4">Configure the settings that you want.</p>
                    <div class="space-y-4"> 
                        <div>
                            <label class="block text-sm font-medium mb-1">Ticker</label>
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
                        <div>
                            <label class="block text-sm font-medium mb-1">Risk/Reward Ratio</label>
                            <Select>
                                <SelectTrigger
                                    class="h-11 w-full border-3 border-foreground bg-background font-bold shadow-[4px_4px_0px_hsl(var(--shadow-color))] focus:translate-x-[4px] focus:translate-y-[4px] focus:shadow-none"
                                >
                                <SelectValue placeholder="Select a ratio" />
                                </SelectTrigger>
                                <SelectContent class="z-[9999] border-3 border-foreground bg-card shadow-[4px_4px_0px_hsl(var(--shadow-color))]">
                                <SelectItem value="1:1" class="font-semibold">1:1</SelectItem>
                                <SelectItem value="1:1.5" class="font-semibold">1:1.5</SelectItem>
                                <SelectItem value="1:2" class="font-semibold">1:2</SelectItem>
                                <SelectItem value="1:3" class="font-semibold">1:3</SelectItem>
                                </SelectContent>
                            </Select>                        
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Strategy</label>
                            <Select>
                                <SelectTrigger
                                    class="h-11 w-full border-3 border-foreground bg-background font-bold shadow-[4px_4px_0px_hsl(var(--shadow-color))] focus:translate-x-[4px] focus:translate-y-[4px] focus:shadow-none"
                                >
                                <SelectValue placeholder="Select a ticker" />
                                </SelectTrigger>
                                <SelectContent class="z-[9999] border-3 border-foreground bg-card shadow-[4px_4px_0px_hsl(var(--shadow-color))]">
                                <SelectItem value="apple" class="font-semibold">Apple</SelectItem>
                                <SelectItem value="banana" class="font-semibold">Banana</SelectItem>
                                <SelectItem value="orange" class="font-semibold">Orange</SelectItem>
                                </SelectContent>
                            </Select>                        
                        </div>
                    </div>
                </CardContent>
                <CardFooter>
                    <Button class="w-full" variant="accent" animation="shake">ANALYZE</Button>
                </CardFooter>
            </Card>
            <Card class="flex flex-col h-full">
                <CardHeader>
                <CardTitle>Result</CardTitle>
                </CardHeader>
                <CardContent class="flex-1 h-fit grid grid-cols-1 md:grid-cols-3 gap-4">
                    <StatCard title="Action" value="BUY" color="success" :icon="DollarSign" class="col-span-3"/>
                    <StatCard title="Entry Price" value="$42,000" variant="compact" color="accent" class="col-span-3 md:col-span-1"/>
                    <StatCard title="Take Profit" value="$44,000" variant="compact" color="info" class="col-span-3 md:col-span-1"/>
                    <StatCard title="Stop Loss" value="$41,000" variant="compact" color="destructive" class="col-span-3 md:col-span-1"/>
                    <p class="font-bold col-span-3">A.I. Rationale: <span class="font-normal">Breakout above resistance with strong volume and posive momentum indicators.</span></p>
                </CardContent>
                <CardFooter>
                    <Button class="w-full" variant="secondary" animation="shake" disabled>PLACE TRADE</Button>
                </CardFooter>
            </Card>
        </CardContent>
    </Card>

</template>
