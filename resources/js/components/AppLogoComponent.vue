<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';

// Définir les props avec un meilleur typage pour un composant SVG

</script>

<template>
  <div class="">
    <div class="w-full max-w-sm">
        <Link :href="route('home')" class="flex flex-col items-center gap-2 font-medium">
            <div class="mb-1 flex h-auto w-[50%] items-center justify-center rounded-md">
                <AppLogoIcon class="size-9 fill-current text-[var(--foreground)] dark:text-white" />
            </div>
        </Link>
    </div>
  </div>
</template>
