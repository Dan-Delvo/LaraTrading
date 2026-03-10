<script setup lang="ts">
import { Toaster as Sonner } from 'vue-sonner'
</script>

<template>
  <Sonner
    position="top-right"
    :toast-options="{
      unstyled: true,
      classes: {
        toast: 'w-full border-3 border-foreground bg-card text-foreground p-4 shadow-[4px_4px_0px_hsl(var(--shadow-color))] flex items-start gap-3 font-mono',
        title: 'font-bold text-sm',
        description: 'text-sm',
        success: 'bg-success text-success-foreground border-foreground',
        error: 'bg-destructive text-white border-foreground',
        warning: 'bg-warning text-warning-foreground border-foreground',
        info: 'bg-info text-info-foreground border-foreground',
        closeButton: 'border-2 border-foreground bg-background hover:bg-accent text-black',
      },
    }"
    :duration="4000"
    close-button
  />
</template>
