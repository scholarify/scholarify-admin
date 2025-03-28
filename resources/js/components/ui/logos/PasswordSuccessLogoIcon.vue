
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
        <rect x="1.25" y="1.25" width="47.5" height="47.5" rx="13.75" stroke="#17b890" stroke-width="2.5"/>
        <path d="M32.5 23.75V30.8333C32.5 31.2754 32.3244 31.6993 32.0118 32.0118C31.6993 32.3244 31.2754 32.5 30.8333 32.5H19.1667C18.7246 32.5 18.3007 32.3244 17.9882 32.0118C17.6756 31.6993 17.5 31.2754 17.5 30.8333V19.1667C17.5 18.7246 17.6756 18.3007 17.9882 17.9882C18.3007 17.6756 18.7246 17.5 19.1667 17.5H29.5833" stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M22.5 24.1654L25 26.6654L33.3333 18.332" stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>

</template>
<style></style>
    