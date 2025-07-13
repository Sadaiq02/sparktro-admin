<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import LoginPageBanner from "@/Components/LoginPageBanner.vue";
import { ref } from "vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const showPassword = ref(false);

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

const fillDemoCredentials = () => {
    form.email = "sparktroadmin@yopmail.com";
    form.password = "Test@1234";
};
</script>

<style scoped>
.fill-demo-btn {
    background-color: var(--sparktro-primary);
}
.fill-demo-btn:hover {
    background-color: var(--sparktro-black);
}
</style>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Left Banner -->
            <div
                class="hidden md:flex md:w-1/2 bg-gray-100 items-center justify-center p-8"
            >
                <LoginPageBanner class="text-gray-500" />
            </div>

            <!-- Right Form -->
            <div
                class="flex flex-col justify-center w-full md:w-1/2 px-4 sm:px-8 md:px-12 py-8 sm:py-12"
            >
                <div class="bg-white rounded-lg shadow-lg p-6 sm:p-8 md:p-12 lg:p-16 max-w-md mx-auto w-full">
                    <!-- Logo -->
                    <div class="flex justify-center mb-6">
                        <Link href="/" aria-label="Home">
                            <ApplicationLogo
                                class="h-10 sm:h-12 w-auto text-gray-700"
                            />
                        </Link>
                    </div>

                    <!-- Heading -->
                    <div class="mb-6 text-center sm:text-left">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
                            Welcome Back
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Please sign in to your account
                        </p>
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-4 sm:space-y-6" novalidate>
                        <!-- Email -->
                        <div>
                            <InputLabel for="email" value="User Email" class="text-sm font-medium text-gray-700" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                aria-required="true"
                                placeholder="Enter your email"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <!-- Password -->
                        <div class="relative">
                            <InputLabel for="password" value="Password" class="text-sm font-medium text-gray-700" />
                            <div class="relative mt-1">
                            <TextInput
                                :type="showPassword ? 'text' : 'password'"
                                id="password"
                                    class="block w-full pr-12 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                aria-required="true"
                                    placeholder="Enter your password"
                            />
                            <button
                                type="button"
                                @click="showPassword = !showPassword"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center text-gray-500 hover:text-gray-700 p-1"
                                tabindex="-1"
                                aria-label="Toggle password visibility"
                            >
                                <svg
                                    v-if="showPassword"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.958 9.958 0 012.766-4.316m1.914-1.4A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.982 9.982 0 01-4.254 5.616M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 3l18 18"
                                    />
                                </svg>
                            </button>
                            </div>
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>

                        <!-- Remember me -->
                        <div class="flex items-center justify-between">
                            <label
                                class="flex items-center text-sm text-gray-600 cursor-pointer"
                            >
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span class="ml-2 select-none"
                                    >Remember me on this device</span
                                >
                            </label>
                        </div>

                        <!-- Demo Credentials Button -->
                        <div class="text-center">
                            <button
                                type="button"
                                @click="fillDemoCredentials"
                                class="text-sm text-teal-600 hover:text-teal-700 underline"
                            >
                                Fill Demo Credentials
                            </button>
                        </div>

                        <!-- Submit -->
                        <div>
                            <PrimaryButton
                                class="w-full flex justify-center items-center text-center bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg px-4 py-3 transition duration-300 shadow-sm"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        form.processing,
                                }"
                                :disabled="form.processing"
                                aria-busy="form.processing"
                            >
                                <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ form.processing ? 'Signing in...' : 'Log in' }}
                            </PrimaryButton>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-center">
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                class="text-sm text-teal-600 hover:text-teal-700 underline"
                                >
                                Forgot your password?
                                </Link>
                            </div>

                        <!-- Register Link -->
                        <div class="text-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600">
                                Don't have an account?
                                <Link
                                    :href="route('register')"
                                    class="text-teal-600 hover:text-teal-700 font-medium underline"
                                        >
                                    Register here
                                </Link>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
