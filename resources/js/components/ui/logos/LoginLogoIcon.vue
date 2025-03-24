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
    <svg class="darkLogo" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="1.25" y="1.25" width="47.5" height="47.5" rx="13.75" stroke="#1e3d59" stroke-width="2.5"/>
        <path d="M27.167 17.832H30.5003C30.9424 17.832 31.3663 18.0076 31.6788 18.3202C31.9914 18.6327 32.167 19.0567 32.167 19.4987V31.1654C32.167 31.6074 31.9914 32.0313 31.6788 32.3439C31.3663 32.6564 30.9424 32.832 30.5003 32.832H27.167" stroke="#1e3d59" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M23 29.4974L27.1667 25.3307L23 21.1641" stroke="#1e3d59" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M27.167 25.332H17.167" stroke="#1e3d59" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>


</template>
<style>

</style>
