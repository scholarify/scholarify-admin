<script setup lang="ts">
import { defineProps, DefineComponent } from 'vue';

// Définir les props avec un meilleur typage pour un composant SVG
defineProps<{
  title?: string;
  description?: string;
  svg_icon: DefineComponent; // Meilleur typage pour un composant Vue
}>();
</script>

<template>
  <div class=" bg-background p-6 md:p-10">
    <div class="">
        <div class="space-y-2 text-center flex flex-col  justify-center items-center">
            <!-- Utilisation correcte du composant SVG -->
            <component v-if="svg_icon" :is="svg_icon" class="w-12 h-12" />
            <h1 class="text-[30px] dark:text-[#17b890] text-[#17b890] font-bold">{{ title }}</h1>
            <p class="text-center text-sm text-muted-foreground">{{ description }}</p>
        </div>
    </div>
  </div>
</template>
