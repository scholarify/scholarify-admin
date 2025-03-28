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
            d="M25.6135 33.0711C25.6452 33.15 25.7002 33.2174 25.7712 33.2641C25.8423 33.3108 25.9259 33.3347 26.0109 33.3325C26.0959 33.3303 26.1781 33.3022 26.2467 33.2519C26.3152 33.2016 26.3668 33.1316 26.3943 33.0511L31.811 17.2178C31.8377 17.144 31.8428 17.0641 31.8257 16.9874C31.8086 16.9108 31.77 16.8406 31.7145 16.7851C31.659 16.7296 31.5888 16.6911 31.5122 16.674C31.4356 16.6569 31.3557 16.662 31.2818 16.6886L15.4485 22.1053C15.3681 22.1329 15.298 22.1844 15.2477 22.253C15.1974 22.3215 15.1693 22.4038 15.1671 22.4888C15.165 22.5738 15.1888 22.6574 15.2355 22.7284C15.2823 22.7994 15.3496 22.8545 15.4285 22.8861L22.0368 25.5361C22.2457 25.6198 22.4355 25.7449 22.5948 25.9038C22.7541 26.0628 22.8795 26.2524 22.9635 26.4611L25.6135 33.0711Z"
            stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M31.7114 16.7891L22.5947 25.9049" stroke="#17b890" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" />
    </svg>


</template>
<style></style>
