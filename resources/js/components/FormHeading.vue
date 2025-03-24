<script setup lang="ts">
import { defineProps, DefineComponent } from 'vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';

// Définir les props avec un meilleur typage pour un composant SVG
defineProps<{
  title?: string;
  description?: string;
  svg_icon?: DefineComponent; // Meilleur typage pour un composant Vue
}>();
</script>

<template>
  <div class="flex min-h-[400px] flex-col items-center justify-between gap-6 bg-background p-6 md:p-10">
    <div class="w-full max-w-sm">
      <div class="flex flex-col gap-8">
        <div class="flex flex-col items-center justify-between gap-4 h-[300px]">
          <Link :href="route('home')" class="flex flex-col items-center gap-2 font-medium">
            <div class="mb-1 flex h-auto w-[50%] items-center justify-center rounded-md">
              <AppLogoIcon class="size-9 fill-current text-[var(--foreground)] dark:text-white" />
            </div>
            <span class="sr-only">{{ title }}</span>
          </Link>
          <div class="space-y-2 text-center flex flex-col gap-4 justify-center items-center">
            <!-- Utilisation correcte du composant SVG -->
            <component v-if="svg_icon" :is="svg_icon" class="w-12 h-12" />
            <h1 class="text-[36px] dark:text-[#1e3d59] font-bold">{{ title }}</h1>
            <p class="text-center text-sm text-muted-foreground">{{ description }}</p>
          </div>
        </div>
        <slot />
      </div>
    </div>
  </div>
</template>
