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

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};

const fillDemoCredentials = () => {
    form.email = "sparktroboard@yopmail.com";
    form.password = "Test@1234";
    // Optionally, you can still copy to clipboard if you want:
    // const text = `Email: sparktroboard@yopmail.com\nPassword: Test@1234`;
    // navigator.clipboard.writeText(text).then(() => {
    //     alert("Credentials copied to clipboard!");
    // });
};
</script>

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
                class="flex flex-col justify-center w-full md:w-1/2 px-8 py-12 sm:px-12 my-5"
            >
                <div class="bg-white rounded-lg shadow-lg pt-20 pb-20 px-16">
                    <!-- Logo -->
                    <div class="flex mb-6">
                        <Link href="/" aria-label="Home">
                            <ApplicationLogo
                                class="h-12 w-auto text-gray-700"
                            />
                        </Link>
                    </div>

                    <!-- Heading -->
                    <div class="mb-6">
                        <h2 class="text-3xl font-bold text-gray-800">
                            Welcome Back
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Please sign in to your account
                        </p>
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-6" novalidate>
                        <!-- Email -->
                        <div>
                            <InputLabel for="email" value="User Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                aria-required="true"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <!-- Password -->
                        <div>
                            <InputLabel for="password" value="Password" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                aria-required="true"
                            />
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

                        <!-- Submit -->
                        <div>
                            <PrimaryButton
                                class="w-full flex justify-center items-center text-center bg-custom-teal text-white font-semibold rounded-lg px-4 py-2 transition duration-300 hover:from-[#0A97B0] hover:to-[#064a55] hover:bg-gradient-to-l"
                                :class="{
                                    'opacity-50 cursor-not-allowed':
                                        form.processing,
                                }"
                                :disabled="form.processing"
                                aria-busy="form.processing"
                            >
                                Log in
                            </PrimaryButton>

                            <div class="mt-4 text-center">
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="text-[#FF4340] font-medium text-[14px] leading-[14px] tracking-[0px] font-worksans hover:underline"
                                >
                                    Forgot password?
                                </Link>
                            </div>
                            <!-- Demo Credentials -->
                            <div
                                class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 mt-6"
                            >
                                <div
                                    class="flex justify-between items-center space-x-4 flex-wrap"
                                >
                                    <!-- Left side: Email and Password -->
                                    <div
                                        class="flex flex-col text-gray-700 dark:text-gray-400 min-w-[180px]"
                                    >
                                        <p class="mb-1 font-normal">
                                            Email: sparktroboard@yopmail.com
                                        </p>
                                        <p class="font-normal">
                                            Password: Test@1234
                                        </p>
                                    </div>

                                    <!-- Right side: Button -->
                                    <div>
                                        <button
                                            type="button"
                                            @click="fillDemoCredentials"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-custom-teal rounded-lg hover:bg-custom-teal focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            Fill in demo credentials
                                            <svg
                                                class="rtl:rotate-180 w-4 h-4 ms-2"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 14 10"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M1 5h12m0 0L9 1m4 4L9 9"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div
                            v-if="status"
                            class="text-sm font-medium text-danger mt-4 text-center"
                            role="alert"
                            aria-live="polite"
                        >
                            {{ status }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
