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
        <g clip-path="url(#clip0_3534_3403)">
            <path
                d="M25.9995 23.332C25.5575 23.332 25.1336 23.5076 24.821 23.8202C24.5085 24.1327 24.3329 24.5567 24.3329 24.9987C24.3329 25.8487 24.2495 27.0904 24.1162 28.332"
                stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M27.6663 25.9336C27.6663 27.9169 27.6663 31.2503 26.833 33.3336" stroke="#17b890" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
            <path d="M30.4082 32.5167C30.5082 32.0167 30.7665 30.6 30.8249 30" stroke="#17b890" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M17.667 25.0013C17.667 23.2523 18.2173 21.5476 19.24 20.1287C20.2626 18.7098 21.7058 17.6487 23.3651 17.0956C25.0244 16.5425 26.8156 16.5255 28.4851 17.047C30.1545 17.5685 31.6176 18.6021 32.667 20.0013"
                stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M17.667 28.332H17.6753" stroke="#17b890" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M34.167 28.332C34.3337 26.6654 34.2762 23.8704 34.167 23.332" stroke="#17b890" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M20.167 31.2487C20.5837 29.9987 21.0003 27.4987 21.0003 24.9987C20.9995 24.4311 21.0953 23.8675 21.2837 23.332"
                stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M23.208 33.3346C23.383 32.7846 23.583 32.2346 23.683 31.668" stroke="#17b890" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" />
            <path
                d="M23.5 20.666C24.2603 20.227 25.1228 19.996 26.0008 19.9961C26.8788 19.9962 27.7412 20.2275 28.5014 20.6668C29.2616 21.106 29.8927 21.7376 30.3313 22.4982C30.7699 23.2587 31.0006 24.1213 31 24.9993V26.666"
                stroke="#17b890" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </g>
        <defs>
            <clipPath id="clip0_3534_3403">
                <rect width="20" height="20" fill="white" transform="translate(16 15)" />
            </clipPath>
        </defs>
    </svg>



</template>
<style></style>
