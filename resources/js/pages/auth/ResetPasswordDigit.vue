<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { LoaderCircle } from 'lucide-vue-next';
import FormHeading from '@/components/FormHeading.vue';
import AppLogoComponent from '@/components/AppLogoComponent.vue';
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import PasswordResetLogoIcon from '@/components/ui/logos/PasswordDigittLogoIcon.vue';

// Initialisation du formulaire avec digits inclus
const form = useForm({
  email: '',
  digits: '', // Ajout des digits dans le form
});

// Gestion des 6 chiffres
const digits = ref(['', '', '', '', '', '']);
const inputs = ref<(HTMLInputElement | null)[]>([]);
const hasError = ref(false); // État pour gérer l'erreur visuelle

// Gestion du compte à rebours
const countdown = ref(25);
let countdownInterval: number | null = null;

// Focus automatique sur le premier champ au montage
onMounted(() => {
  inputs.value[0]?.focus();
  startCountdown();
});

// Gestion de l'entrée dans les champs
const handleInput = (index: number, event: Event) => {
  const input = event.target as HTMLInputElement;
  const value = input.value;

  // Accepter uniquement les chiffres
  if (!/^\d$/.test(value) && value !== '') {
    digits.value[index] = '';
    return;
  }

  // Passer au champ suivant si un chiffre est entré
  if (value && index < 5) {
    inputs.value[index + 1]?.focus();
  }

  // Mettre à jour form.digits
  form.digits = digits.value.join('');
  hasError.value = false; // Réinitialiser l'erreur si l'utilisateur commence à corriger
};

// Gestion des touches (backspace, flèches)
const handleKeydown = (index: number, event: KeyboardEvent) => {
  if (event.key === 'Backspace' && !digits.value[index] && index > 0) {
    inputs.value[index - 1]?.focus();
  } else if (event.key === 'ArrowLeft' && index > 0) {
    inputs.value[index - 1]?.focus();
  } else if (event.key === 'ArrowRight' && index < 5) {
    inputs.value[index + 1]?.focus();
  }
};

// Soumission du formulaire
const submitForm = () => {
  const code = digits.value.join('');
  form.digits = code; // Mettre à jour form.digits avant la soumission

  if (code.length !== 6 || !/^\d{6}$/.test(code)) {
    hasError.value = true; // Activer l'état d'erreur pour déclencher l'animation
    form.errors.digits = 'Veuillez entrer un code à 6 chiffres valide.'; // Stocker le message d'erreur
    return;
  }

  // Si tout est correct, soumettre le formulaire
  form.post(route('password.digits'), {
    onError: () => {
      hasError.value = true; // Activer l'erreur si la soumission échoue
    },
  });
};

// Gestion du compte à rebours
const startCountdown = () => {
  countdown.value = 25;
  countdownInterval = setInterval(() => {
    countdown.value--;
    if (countdown.value <= 0) {
      clearInterval(countdownInterval!);
    }
  }, 1000);
};

// Ré-envoyer le code
const resendCode = () => {
  if (countdown.value > 0) return;
  console.log('Ré-envoyer le code OTP');
  // Ici, vous pouvez appeler votre API pour renvoyer le code
  startCountdown();
};
</script>

<template>
  <div class="flex">
    <div class="asideLogo w-[50%] h-svh">
      <div class="asideImage"></div>
      <img src="/images/asideImage.png" height="100" class="h-svh" alt="" />
    </div>

    <div class="asideForm h-svh flex flex-col justify-evenly items-center m-auto w-full max-w-[500px]">
      <AppLogoComponent />
      <div class="formContent">
        <FormHeading
          title="Password Reset"
          description="Enter your 6 digit OTP code in order to reset"
          :svg_icon="PasswordResetLogoIcon"
        />

        <div>
          <form @submit.prevent="submitForm" class="flex flex-col gap-6">
            <div class="grid gap-6">
              <!-- Champs pour les 6 chiffres -->
              <div class="flex justify-center gap-2">
                <input
                  v-for="(digit, index) in digits"
                  :key="index"
                  v-model="digits[index]"
                  type="text"
                  maxlength="1"
                  class="h-12 w-12 rounded-lg border text-center text-black text-2xl font-medium focus:border-[#17b890] focus:outline-none"
                  :class="{
                    'border-gray-300': !hasError,
                    'border-red-500 animate-shake': hasError,
                  }"
                  @input="handleInput(index, $event)"
                  @keydown="handleKeydown(index, $event)"
                  ref="inputs"
                />
              </div>

              <!-- Affichage du message d'erreur -->
              <div v-if="form.errors.digits" class="text-center text-sm text-red-500">
                {{ form.errors.digits }}
              </div>

              <div class="my-6 flex items-center justify-start">
                <Button
                  class="w-full mt-4 bg-[#17b890] hover:bg-[#1e856b]"
                  :disabled="form.processing"
                >
                  <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                  Reset Password
                  <svg
                    width="21"
                    height="20"
                    viewBox="0 0 21 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M16.75 5.9375H14.5625V4.375C14.5625 3.29756 14.1345 2.26425 13.3726 1.50238C12.6108 0.740512 11.5774 0.3125 10.5 0.3125C9.42256 0.3125 8.38925 0.740512 7.62738 1.50238C6.86551 2.26425 6.4375 3.29756 6.4375 4.375V5.9375H4.25C3.8356 5.9375 3.43817 6.10212 3.14515 6.39515C2.85212 6.68817 2.6875 7.0856 2.6875 7.5V16.25C2.6875 16.6644 2.85212 17.0618 3.14515 17.3549C3.43817 17.6479 3.8356 17.8125 4.25 17.8125H16.75C17.1644 17.8125 17.5618 17.6479 17.8549 17.3549C18.1479 17.0618 18.3125 16.6644 18.3125 16.25V7.5C18.3125 7.0856 18.1479 6.68817 17.8549 6.39515C17.5618 6.10212 17.1644 5.9375 16.75 5.9375ZM8.3125 4.375C8.3125 3.79484 8.54297 3.23844 8.9532 2.8282C9.36344 2.41797 9.91984 2.1875 10.5 2.1875C11.0802 2.1875 11.6366 2.41797 12.0468 2.8282C12.457 3.23844 12.6875 3.79484 12.6875 4.375V5.9375H8.3125V4.375ZM16.4375 15.9375H4.5625V7.8125H16.4375V15.9375Z"
                      fill="#F5F6FA"
                    />
                  </svg>
                </Button>
              </div>
            </div>

            <!-- Lien Re-send OTP Code -->
            <div class="text-center">
              <p class="text-sm text-gray-600">
                Didn't receive the code?
                <a
                  href="#"
                  class="text-blue-500 hover:underline"
                  :class="{ 'pointer-events-none opacity-50': countdown > 0 }"
                  @click.prevent="resendCode"
                >
                  Re-send OTP Code
                  <span v-if="countdown > 0">in {{ countdown }}s</span>
                </a>
              </p>
            </div>
          </form>
        </div>
      </div>
      <div class="navigation-bars flex gap-2 p-2">
        <div class="navigationItem"></div>
        <div class="navigationItem active"></div>
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

/* Animation de vibration */
@keyframes shake {
  0% { transform: translateX(0); }
  25% { transform: translateX(-5px); }
  50% { transform: translateX(5px); }
  75% { transform: translateX(-5px); }
  100% { transform: translateX(0); }
}

.animate-shake {
  animation: shake 0.3s ease-in-out;
}
</style>