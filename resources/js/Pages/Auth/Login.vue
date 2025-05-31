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
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Left Banner -->
            <div class="hidden md:flex md:w-1/2 bg-gray-100 items-center justify-center p-8">
                <LoginPageBanner class="text-gray-500" />
            </div>

            <!-- Right Form -->
            <div class="flex flex-col justify-center w-full md:w-1/2 px-8 py-12 sm:px-12 my-5">
                <div class="flex flex-col justify-center w-full md:w-1/2 px-8 py-12 sm:px-12 my-5">
                    <div class="bg-white rounded-lg shadow-lg pt-20 pb-20"
                        style="width: 660px; height: 644px; padding-right: 60px; padding-left: 60px;">
                        <!-- Logo -->
                        <div class="flex mb-6">
                            <Link href="/">
                            <ApplicationLogo class="h-12 w-auto text-gray-700" />
                            </Link>
                        </div>

                        <!-- Heading -->
                        <div class="mb-6">
                            <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
                            <p class="text-sm text-gray-500 mt-1">Please sign in to your account</p>
                        </div>

                        <!-- Form -->
                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Email -->
                            <div>
                                <InputLabel for="email" value="User Email" />
                                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                                    required autofocus autocomplete="username" />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <!-- Password -->
                            <div>
                                <InputLabel for="password" value="Password" />
                                <TextInput id="password" type="password" class="mt-1 block w-full"
                                    v-model="form.password" required autocomplete="current-password" />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <!-- Remember me -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center text-sm text-gray-600">
                                    <Checkbox name="remember" v-model:checked="form.remember" />
                                    <span class="ml-2">Remember me on this device</span>
                                </label>
                            </div>

                            <!-- Submit -->
                            <div>
                                <PrimaryButton
                                    class="w-full flex justify-center items-center text-center bg-[#0A97B0] text-white font-semibold rounded-lg px-4 py-2 transition-colors duration-300 hover:bg-gradient-to-l"
                                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Log in
                                </PrimaryButton>

                                <div class="mt-4 text-center">
                                    <Link v-if="canResetPassword" :href="route('password.request')"
                                        class="text-[#FF4340] font-medium text-[14px] leading-[14px] tracking-[0px] text-center font-worksans hover:underline">
                                    Forgot password?
                                    </Link>
                                </div>
                            </div>

                            <!-- Status -->
                            <div v-if="status" class="text-sm font-medium text-danger mt-4 text-center">
                                {{ status }}
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </GuestLayout>
</template>
