<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import NotificationCard from '@/components/ui/notification/NotificationCard.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';
import FormHeading from '@/components/FormHeading.vue';
import LoginLogoIcon from '@/components/ui/logos/LoginLogoIcon.vue';
import AppLogoComponent from '@/components/AppLogoComponent.vue';
import { set } from '@vueuse/core';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
    credentialsError: ""
});

const notificationVisible = ref(false);

interface LoginResponse {
    success: boolean;
    token: string;
    redirect: string;
}

const submit = () => {

    form.post(route('login'), {
        onFinish: () => {
            form.reset('password')

        },
        onError: (errors) => {
            if (errors.credentials) {
                form.errors.credentialsError = errors.credentials;
                console.log(errors.credentials, 'form errors');
                notificationVisible.value = true;
                setTimeout(() => {
                    notificationVisible.value = false;
                }, 5000);
            }
        },
        onSuccess: (response) => {
            // Gérer la réponse JSON
            const data = response?.props?.data as LoginResponse; // Inertia passe les données dans props.data
            if (data?.success) {
                // Stocker le token dans localStorage
                localStorage.setItem('idToken', data.token);
                // Rediriger vers /admin
                window.location.href = data.redirect;
                notificationVisible.value = false;
            } else {
                form.errors.credentialsError = "Erreur lors de la connexion.";
                notificationVisible.value = true;
            }
        }
    });
};
const closeNotification = () => {
    notificationVisible.value = false;
}
</script>

<template>
    <div class="flex mainContaner">
        <div class="asideLogo w-[50%] h-svh">
            <div class="asideImage">

            </div>
            <img src="/images/asideImage.png" height="100" class="h-svh" alt="">
        </div>
        <div class="asideForm h-svh flex flex-col justify-evenly items-center p-6 m-auto w-full max-w-[500px]">
            <AppLogoComponent />
            <div class="formContent">
                <FormHeading title="Nice to see you!" description="Sign in to access your Dashboard"
                    :svg_icon="LoginLogoIcon" />
                <NotificationCard v-if="form.errors.credentialsError" type="error"
                    :message="form.errors.credentialsError" :visible="notificationVisible" @close="closeNotification" />
                <div class="">
                    <form @submit.prevent="submit" class="flex flex-col ">
                        <div class="grid gap-6">
                            <div class="grid gap-2">
                                <Label for="email">Email address</Label>
                                <Input id="email" type="email" required autofocus :tabindex="1" autocomplete="email"
                                    v-model="form.email" placeholder="email@example.com" />
                                <InputError :message="form.errors.email" />
                            </div>

                            <div class="grid gap-2">
                                <div class="space-y-2">
                                    <Label for="password">Password</Label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.25 5.9375H12.0625V4.375C12.0625 3.29756 11.6345 2.26425 10.8726 1.50238C10.1108 0.740512 9.07744 0.3125 8 0.3125C6.92256 0.3125 5.88925 0.740512 5.12738 1.50238C4.36551 2.26425 3.9375 3.29756 3.9375 4.375V5.9375H1.75C1.3356 5.9375 0.938171 6.10212 0.645146 6.39515C0.35212 6.68817 0.1875 7.0856 0.1875 7.5V16.25C0.1875 16.6644 0.35212 17.0618 0.645146 17.3549C0.938171 17.6479 1.3356 17.8125 1.75 17.8125H14.25C14.6644 17.8125 15.0618 17.6479 15.3549 17.3549C15.6479 17.0618 15.8125 16.6644 15.8125 16.25V7.5C15.8125 7.0856 15.6479 6.68817 15.3549 6.39515C15.0618 6.10212 14.6644 5.9375 14.25 5.9375ZM5.8125 4.375C5.8125 3.79484 6.04297 3.23844 6.4532 2.8282C6.86344 2.41797 7.41984 2.1875 8 2.1875C8.58016 2.1875 9.13656 2.41797 9.5468 2.8282C9.95703 3.23844 10.1875 3.79484 10.1875 4.375V5.9375H5.8125V4.375ZM13.9375 15.9375H2.0625V7.8125H13.9375V15.9375Z"
                                                    fill="#575D5E" />
                                            </svg>

                                        </span>
                                        <Input id="password" v-model="form.password" autocomplete="current-password"
                                            type="password"
                                            class="block w-full rounded-lg border border-gray-300 py-2 pl-10 pr-10 text-sm focus:border-blue-500 focus:outline-none"
                                            placeholder="••••••••••••" required :tabindex="2" />

                                    </div>
                                </div>
                                <InputError :message="form.errors.password" />
                            </div>

                            <div class="flex items-center justify-between" :tabindex="3">
                                <Label for="remember" class="flex items-center space-x-3">
                                    <Checkbox class="border dark:border-white border-[#1e3D59]" id="remember"
                                        v-model:checked="form.remember" :tabindex="4" />
                                    <span>Remember me</span>
                                </Label>

                                <TextLink v-if="canResetPassword" :href="route('password.request')"
                                    class="text-sm text-[#1e3D59]" :tabindex="5">
                                    Forgot password?
                                </TextLink>
                            </div>

                            <Button type="submit" class="mt-4 w-full bg-[#17b890] hover:bg-[#1e856b]" :tabindex="4"
                                :disabled="form.processing">
                                <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                                Log in
                                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.1875 16.875C10.1875 17.1236 10.0887 17.3621 9.91291 17.5379C9.7371 17.7137 9.49864 17.8125 9.25 17.8125H4.25C4.00136 17.8125 3.7629 17.7137 3.58709 17.5379C3.41127 17.3621 3.3125 17.1236 3.3125 16.875V3.125C3.3125 2.87636 3.41127 2.6379 3.58709 2.46209C3.7629 2.28627 4.00136 2.1875 4.25 2.1875H9.25C9.49864 2.1875 9.7371 2.28627 9.91291 2.46209C10.0887 2.6379 10.1875 2.87636 10.1875 3.125C10.1875 3.37364 10.0887 3.6121 9.91291 3.78791C9.7371 3.96373 9.49864 4.0625 9.25 4.0625H5.1875V15.9375H9.25C9.49864 15.9375 9.7371 16.0363 9.91291 16.2121C10.0887 16.3879 10.1875 16.6264 10.1875 16.875ZM18.6633 9.33672L15.5383 6.21172C15.3622 6.0356 15.1233 5.93665 14.8742 5.93665C14.6251 5.93665 14.3863 6.0356 14.2102 6.21172C14.034 6.38784 13.9351 6.62671 13.9351 6.87578C13.9351 7.12485 14.034 7.36372 14.2102 7.53984L15.7344 9.0625H9.25C9.00136 9.0625 8.7629 9.16127 8.58709 9.33709C8.41127 9.5129 8.3125 9.75136 8.3125 10C8.3125 10.2486 8.41127 10.4871 8.58709 10.6629C8.7629 10.8387 9.00136 10.9375 9.25 10.9375H15.7344L14.2094 12.4617C14.0333 12.6378 13.9343 12.8767 13.9343 13.1258C13.9343 13.3749 14.0333 13.6137 14.2094 13.7898C14.3855 13.966 14.6244 14.0649 14.8734 14.0649C15.1225 14.0649 15.3614 13.966 15.5375 13.7898L18.6625 10.6648C18.7499 10.5778 18.8194 10.4743 18.8667 10.3604C18.9141 10.2465 18.9386 10.1243 18.9386 10.0009C18.9387 9.87755 18.9144 9.75537 18.8672 9.64138C18.8199 9.5274 18.7506 9.42387 18.6633 9.33672Z"
                                        fill="#F5F6FA" />
                                </svg>

                            </Button>
                        </div>

                        <div class="text-center text-sm text-muted-foreground">
                            Don't have an account?
                            <TextLink :href="route('register')" :tabindex="5">Sign up</TextLink>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.asideForm {
    width: 50%;
}
.mainContaner .asideLogo{
    display: none;
}
@media (min-width: 768px) {
    .asideForm {
        width: 50%;
    }
    .mainContaner .asideLogo{
        display: block;
        width: 50%;
    }
}
</style>
