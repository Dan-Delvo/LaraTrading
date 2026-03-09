<script setup lang="ts">
import { onMounted, ref } from 'vue';
import Card from '../ui/Card.vue';
import CardContent from '../ui/CardContent.vue';
import CardHeader from '../ui/CardHeader.vue';
import CardTitle from '../ui/CardTitle.vue';
import { useAppearance } from '@/composables/useAppearance'

const { resolvedAppearance } = useAppearance() 


const container = ref<HTMLDivElement | null>(null);

onMounted(() => {
  if (!container.value) return;

  const script = document.createElement('script');
  script.src = 'https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js';
  script.type = 'text/javascript';
  script.async = true;
  script.innerHTML = JSON.stringify({
    "autosize": true,
    "symbol": "BINANCE:BTCUSDT",
    "interval": "D",
    "timezone": "Etc/UTC",
    "theme": resolvedAppearance.value === 'dark' ? 'dark' : 'light', 
    "style": "1",
    "locale": "en",
    "enable_publishing": false,
    "allow_symbol_change": true,
    "container_id": "tradingview_chart"
  });
  container.value.appendChild(script);
});

</script>

<template>

  <Card class="flex h-full flex-col">
    <CardHeader class="bg-primary">
      <CardTitle>Live Chart</CardTitle>
    </CardHeader>

    <CardContent class="min-h-0 flex-1 p-0">
      <div id="tradingview_chart" ref="container" class="h-full w-full"></div>
    </CardContent>
  </Card>

</template>