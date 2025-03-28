<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';
import { Button } from '@/components/ui/button';
import { useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { ref } from 'vue';
import NewPasswordLogoIcon from '@/components/ui/logos/NewPasswordLogoIcon.vue';
import FormHeading from '@/components/FormHeading.vue';
import AppLogoComponent from '@/components/AppLogoComponent.vue';
interface Props {
    digits: string;
    email: string;
}

const props = defineProps<Props>();

const form = useForm({
    email: props.email,
    password: '',
    password_confirmation: '',
});




const showPassword = ref(false);
const passwordStrength = ref(0); // 0 à 4 (4 segments de la barre)

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const checkPasswordStrength = () => {
    const password = form.password;
    let strength = 0;

    // Critères de force du mot de passe
    if (password.length >= 8) strength++; // Longueur minimale
    if (/[A-Z]/.test(password)) strength++; // Lettre majuscule
    if (/[0-9]/.test(password)) strength++; // Chiffre
    if (/[^A-Za-z0-9]/.test(password)) strength++; // Caractère spécial

    passwordStrength.value = strength;
};

const getProgressBarClass = (index: number) => {
    if (index <= passwordStrength.value) {
        return 'bg-green-500';
    }
    return 'bg-gray-200';
};

const submitForm = () => {

    if (form.password !== form.password_confirmation) {
        form.errors.password_confirmation = "The passwords are incompatible"
        return;
    }

    if (passwordStrength.value < 3) {
        form.errors.password = "The passeword is low. It must contain at least 8 caracters, 1 uppercase, 1 number and 1 special carater"
        return;
    }

    console.log('Mot de passe soumis :', form.password);
    form.post(route("password.success"), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    })
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
                <FormHeading title="Set new password" description="Must be at least 8 characters."
                    :svg_icon="NewPasswordLogoIcon" />

                <div class="">
                    <form @submit.prevent="submitForm" class="flex flex-col gap-6">
                        <div class="grid gap-6">
                            <div class="space-y-2">
                                <Label for="new-password">New Password</Label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.25 5.9375H12.0625V4.375C12.0625 3.29756 11.6345 2.26425 10.8726 1.50238C10.1108 0.740512 9.07744 0.3125 8 0.3125C6.92256 0.3125 5.88925 0.740512 5.12738 1.50238C4.36551 2.26425 3.9375 3.29756 3.9375 4.375V5.9375H1.75C1.3356 5.9375 0.938171 6.10212 0.645146 6.39515C0.35212 6.68817 0.1875 7.0856 0.1875 7.5V16.25C0.1875 16.6644 0.35212 17.0618 0.645146 17.3549C0.938171 17.6479 1.3356 17.8125 1.75 17.8125H14.25C14.6644 17.8125 15.0618 17.6479 15.3549 17.3549C15.6479 17.0618 15.8125 16.6644 15.8125 16.25V7.5C15.8125 7.0856 15.6479 6.68817 15.3549 6.39515C15.0618 6.10212 14.6644 5.9375 14.25 5.9375ZM5.8125 4.375C5.8125 3.79484 6.04297 3.23844 6.4532 2.8282C6.86344 2.41797 7.41984 2.1875 8 2.1875C8.58016 2.1875 9.13656 2.41797 9.5468 2.8282C9.95703 3.23844 10.1875 3.79484 10.1875 4.375V5.9375H5.8125V4.375ZM13.9375 15.9375H2.0625V7.8125H13.9375V15.9375Z"
                                                fill="#575D5E" />
                                        </svg>
                                    </span>
                                    <Input id="new-password" v-model="form.password"
                                        :type="showPassword ? 'text' : 'password'"
                                        class="block w-full tex rounded-lg dark border border-gray-300 py-2 pl-10 pr-10 text-sm focus:border-blue-500 focus:outline-none"
                                        placeholder="••••••••••••" @input="checkPasswordStrength" />
                                    <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3"
                                        @click="togglePasswordVisibility">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                </div>
                                <!-- Barre de progression -->
                                <div class="flex gap-1">
                                    <div v-for="i in 4" :key="i" class="h-1 w-1/4 rounded-full"
                                        :class="getProgressBarClass(i)"></div>
                                </div>
                                <InputError :message="form.errors.password" />
                            </div>

                            <!-- Champ Confirm Password -->
                            <div class="space-y-2">
                                <Label for="confirm-password">Confirm Password</Label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.25 5.9375H12.0625V4.375C12.0625 3.29756 11.6345 2.26425 10.8726 1.50238C10.1108 0.740512 9.07744 0.3125 8 0.3125C6.92256 0.3125 5.88925 0.740512 5.12738 1.50238C4.36551 2.26425 3.9375 3.29756 3.9375 4.375V5.9375H1.75C1.3356 5.9375 0.938171 6.10212 0.645146 6.39515C0.35212 6.68817 0.1875 7.0856 0.1875 7.5V16.25C0.1875 16.6644 0.35212 17.0618 0.645146 17.3549C0.938171 17.6479 1.3356 17.8125 1.75 17.8125H14.25C14.6644 17.8125 15.0618 17.6479 15.3549 17.3549C15.6479 17.0618 15.8125 16.6644 15.8125 16.25V7.5C15.8125 7.0856 15.6479 6.68817 15.3549 6.39515C15.0618 6.10212 14.6644 5.9375 14.25 5.9375ZM5.8125 4.375C5.8125 3.79484 6.04297 3.23844 6.4532 2.8282C6.86344 2.41797 7.41984 2.1875 8 2.1875C8.58016 2.1875 9.13656 2.41797 9.5468 2.8282C9.95703 3.23844 10.1875 3.79484 10.1875 4.375V5.9375H5.8125V4.375ZM13.9375 15.9375H2.0625V7.8125H13.9375V15.9375Z"
                                                fill="#575D5E" />
                                        </svg>

                                    </span>
                                    <Input id="confirm-password" v-model="form.password_confirmation"
                                        :type="showPassword ? 'text' : 'password'"
                                        class="block w-full rounded-lg border border-gray-300 py-2 pl-10 pr-10 text-sm focus:border-blue-500 focus:outline-none"
                                        placeholder="••••••••••••" />
                                    <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3"
                                        @click="togglePasswordVisibility">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                                <InputError :message="form.errors.password_confirmation" />

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
                    </form>
                </div>
            </div>
            <div class="navigation-bars flex gap-2 p-2">
                <div class="navigationItem"></div>
                <div class="navigationItem"></div>
                <div class="navigationItem active"></div>
                <div class="navigationItem"></div>
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