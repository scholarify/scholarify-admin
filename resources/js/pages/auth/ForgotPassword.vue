<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import FormHeading from '@/components/FormHeading.vue';
import ResetPasswordIcon from '@/components/ui/logos/resetPasswordIcon.vue';
import AppLogoComponent from '@/components/AppLogoComponent.vue';
defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
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
                <FormHeading title="Forgot your password?" description="No worries, we'll send you reset instructions."
                    :svg_icon="ResetPasswordIcon" />

                <div class="">
                    <form @submit.prevent="submit" class="flex flex-col gap-6">
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label for="email">Email address</Label>
                                <Input id="email" type="email" name="email" autocomplete="off" v-model="form.email"
                                    autofocus placeholder="email@example.com" />
                                <InputError :message="form.errors.email" />
                            </div>


                            <div class="my-6 flex items-center justify-start">
                                <Button class="w-full mt-4 w-full bg-[#17b890] hover:bg-[#1e856b]"
                                    :disabled="form.processing">
                                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                    Reset Password
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.75 5.9375H14.5625V4.375C14.5625 3.29756 14.1345 2.26425 13.3726 1.50238C12.6108 0.740512 11.5774 0.3125 10.5 0.3125C9.42256 0.3125 8.38925 0.740512 7.62738 1.50238C6.86551 2.26425 6.4375 3.29756 6.4375 4.375V5.9375H4.25C3.8356 5.9375 3.43817 6.10212 3.14515 6.39515C2.85212 6.68817 2.6875 7.0856 2.6875 7.5V16.25C2.6875 16.6644 2.85212 17.0618 3.14515 17.3549C3.43817 17.6479 3.8356 17.8125 4.25 17.8125H16.75C17.1644 17.8125 17.5618 17.6479 17.8549 17.3549C18.1479 17.0618 18.3125 16.6644 18.3125 16.25V7.5C18.3125 7.0856 18.1479 6.68817 17.8549 6.39515C17.5618 6.10212 17.1644 5.9375 16.75 5.9375ZM8.3125 4.375C8.3125 3.79484 8.54297 3.23844 8.9532 2.8282C9.36344 2.41797 9.91984 2.1875 10.5 2.1875C11.0802 2.1875 11.6366 2.41797 12.0468 2.8282C12.457 3.23844 12.6875 3.79484 12.6875 4.375V5.9375H8.3125V4.375ZM16.4375 15.9375H4.5625V7.8125H16.4375V15.9375Z"
                                            fill="#F5F6FA" />
                                    </svg>

                                </Button>
                            </div>
                        </div>

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
                    </form>
                </div>
            </div>
            <div class="navigation-bars flex gap-2 p-2">
                <div class="navigationItem active"></div>
                <div class="navigationItem"></div>
                <div class="navigationItem"></div>
                <div class="navigationItem"></div>
            </div>
        </div>
    </div>
</template>
<style>
.asideForm {
    width: 50%;
}
.navigation-bars{
    width: 100%;
}
.navigation-bars .navigationItem{
    height:5px;
    width: 100%;
    background: #8e9eac;
    border-radius: 20px;
}
.navigation-bars .navigationItem.active{
    background: #17b890;
}
</style>
