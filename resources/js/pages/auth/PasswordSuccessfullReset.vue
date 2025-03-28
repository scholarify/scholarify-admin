<script setup lang="ts">

import FormHeading from '@/components/FormHeading.vue';
import AppLogoComponent from '@/components/AppLogoComponent.vue';
import PasswordSuccessLogoIcon from '@/components/ui/logos/PasswordSuccessLogoIcon.vue';
import TextLink from '@/components/TextLink.vue';

</script>

<template>
    <div class="flex">
        <div class="asideLogo w-[50%] h-svh">
            <div class="asideImage">

            </div>
            <img src="/images/asideImage.png" height="100" class="h-svh" alt="">
        </div>

        <div class="asideForm h-svh flex flex-col justify-evenly items-center  m-auto w-full max-w-[500px]">
            <AppLogoComponent />
            <div class="formContent">
                <FormHeading title="Food to go!" description="Your password has been successfully updated."
                    :svg_icon="PasswordSuccessLogoIcon" />

                <div class="">
                    <div class="space-x-1 text-center text-sm text-muted-foreground flex w-full justify-center">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.1634 15.5876C13.3396 15.7637 13.4385 16.0026 13.4385 16.2516C13.4385 16.5007 13.3396 16.7396 13.1634 16.9157C12.9873 17.0918 12.7484 17.1908 12.4994 17.1908C12.2503 17.1908 12.0114 17.0918 11.8353 16.9157L5.58531 10.6657C5.49791 10.5786 5.42856 10.4751 5.38124 10.3611C5.33393 10.2472 5.30957 10.125 5.30957 10.0016C5.30957 9.87824 5.33393 9.75606 5.38124 9.64211C5.42856 9.52815 5.49791 9.42466 5.58531 9.33756L11.8353 3.08756C12.0114 2.91144 12.2503 2.8125 12.4994 2.8125C12.7484 2.8125 12.9873 2.91144 13.1634 3.08756C13.3396 3.26368 13.4385 3.50255 13.4385 3.75163C13.4385 4.0007 13.3396 4.23957 13.1634 4.41569L7.57828 10.0008L13.1634 15.5876Z"
                                    fill="#1E3D59" />
                            </svg>

                            <span>Back to </span>
                            <TextLink :href="route('login')">log in</TextLink>
                        </div>
                </div>
            </div>
            <div class="navigation-bars flex gap-2 p-2">
                <div class="navigationItem"></div>
                <div class="navigationItem"></div>
                <div class="navigationItem"></div>
                <div class="navigationItem active"></div>
            </div>
        </div>
    </div>
</template>
<style>
.asideForm {
    width: 50%;
}

.navigation-bars {
    width: 100%;
}

.navigation-bars .navigationItem {
    height: 5px;
    width: 100%;
    background: #8e9eac;
    border-radius: 20px;
}

.navigation-bars .navigationItem.active {
    background: #17b890;
}
</style>