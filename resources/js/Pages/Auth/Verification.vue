<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Verification from "@/Components/Verification.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { ref, watch, onMounted } from "vue";

const props = defineProps({
    status: String,
    errors: Object,
});

const codeDigits = ref(["", "", "", ""]);

const inputRefs = ref([]);

const form = useForm({
    code: "",
});

const resendForm = useForm({});

const focusNext = (index) => {
    if (codeDigits.value[index] && index < 3) {
        inputRefs.value[index + 1]?.focus();
    }
};

const handleInput = (event, index) => {
    const value = event.target.value;
    if (/^\d$/.test(value)) {
        codeDigits.value[index] = value;
        focusNext(index);
    } else {
        codeDigits.value[index] = "";
    }
};

const submit = () => {
    form.code = codeDigits.value.join("");
    form.post(route("verification.store"));
};

const resendCode = () => {
    resendForm.post(route("verification.resend"));
};

// Auto-focus first input on mount
onMounted(() => {
    if (inputRefs.value[0]) {
        inputRefs.value[0].focus();
    }
});
</script>

<template>
    <GuestLayout>
        <Head title="Verification" />

        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Left Illustration -->
            <div class="hidden md:flex md:w-1/2 bg-gray-100 items-center justify-center p-8">
                <Verification class="max-w-[400px] w-full" />
            </div>

            <!-- Right Form Section -->
            <div class="flex flex-col justify-center w-full md:w-1/2 px-6 sm:px-12 py-12 my-5">
                <div class="bg-white rounded-xl shadow-lg px-10 py-14 w-full max-w-[480px] mx-auto">
                    <!-- Logo -->
                    <div class="flex mb-6">
                        <Link href="/" aria-label="Home">
                            <ApplicationLogo class="h-10" />
                        </Link>
                    </div>

                    <!-- Title -->
                    <h2 class="text-2xl font-bold text-[#1E1E1E] mb-2">Verification</h2>
                    <p class="text-sm text-gray-500 mb-6">
                        Enter your 4 digits code that you received on your email.
                    </p>

                    <!-- Verification Code Inputs -->
                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="flex justify-between gap-3 mb-4">
                            <input
                                v-for="(digit, index) in codeDigits"
                                :key="index"
                                v-model="codeDigits[index]"
                                type="text"
                                maxlength="1"
                                @input="(e) => handleInput(e, index)"
                                ref="el => inputRefs[index] = el"
                                class="w-14 h-14 text-center border border-gray-300 rounded-lg text-lg focus:outline-none focus:ring-2 focus:ring-teal-600"
                                :class="{ 'border-red-500': errors?.code }"
                            />
                        </div>

                        <!-- Error Message -->
                        <div v-if="errors?.code" class="text-red-500 text-sm text-center">
                            {{ errors.code }}
                        </div>

                        <!-- Status Message -->
                        <div v-if="status" class="text-green-600 text-sm text-center">
                            {{ status }}
                        </div>

                        <!-- Verify Button -->
                        <button
                            type="submit"
                            class="w-full bg-[#008CA2] hover:bg-[#00778B] text-white py-3 rounded-lg transition duration-300 uppercase text-sm button-text"
                            :disabled="form.processing"
                        >
                            VERIFY
                        </button>

                        <!-- Resend Option -->
                        <div class="text-center mt-4 text-sm text-gray-500">
                            If you didn't receive a code!
                            <button
                                type="button"
                                @click="resendCode"
                                class="text-[#FF4340] cursor-pointer hover:underline"
                                :disabled="resendForm.processing"
                            >
                                Resend
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
.button-text {
  color: #FFF;
  text-align: center;
  font-family: "Work Sans", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 16px;
  text-transform: uppercase;
}
</style>
