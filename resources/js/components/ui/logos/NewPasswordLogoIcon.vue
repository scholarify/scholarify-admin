<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="1.25" y="1.25" width="47.5" height="47.5" rx="13.75" stroke="#17b890" stroke-width="2.5" />
        <path
            d="M31.667 20H18.3337C17.4132 20 16.667 20.7462 16.667 21.6667V28.3333C16.667 29.2538 17.4132 30 18.3337 30H31.667C32.5875 30 33.3337 29.2538 33.3337 28.3333V21.6667C33.3337 20.7462 32.5875 20 31.667 20Z"
            stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M25 25H25.0083" stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M29.167 25H29.1753" stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M20.833 25H20.8413" stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>


</template>
<style></style>