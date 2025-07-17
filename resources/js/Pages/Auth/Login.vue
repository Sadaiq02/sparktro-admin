<script setup>
import { ref } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
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

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="min-h-screen bg-[#F8F8F8] flex flex-col md:flex-row items-center justify-center px-4 md:px-12 py-8">
            <!-- Left: Illustration -->
            <div class="hidden md:flex md:w-1/2 justify-center items-center">
                <LoginPageBanner class="max-w-[400px] w-full" />
            </div>

            <!-- Right: Form -->
            <div class="w-full md:w-1/2 flex justify-center">
                <div class="w-full max-w-[480px] bg-white shadow-lg rounded-2xl px-8 sm:px-12 py-10">
                    <!-- Logo -->
                    <div class="mb-6 flex justify-center">
                        <Link href="/" aria-label="Home">
                            <ApplicationLogo class="h-10 w-auto" />
                        </Link>
                    </div>

                    <!-- Heading -->
                    <div class="mb-8 text-center">
                        <h2 class="text-2xl font-semibold text-[#1E1E1E]">Welcome Back</h2>
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-5">
                        <!-- Email -->
                        <div>
                            <InputLabel for="email" value="User Name" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full placeholder-gray-400"
                                v-model="form.email"
                                placeholder="example@gmail.com"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <!-- Password -->
                      <!-- Password -->
<div class="relative">
  <InputLabel for="password" value="Password" />
  <TextInput
    :type="showPassword ? 'text' : 'password'"
    id="password"
    class="mt-1 block w-full pr-12 placeholder-gray-400"
    v-model="form.password"
    placeholder="Password@123"
    required
    autocomplete="current-password"
  />

  <!-- Toggle password visibility -->
  <button
  type="button"
  @click="showPassword = !showPassword"
  class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
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
      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 
      9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 
      0-8.268-2.943-9.542-7z"
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
      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.958 
      9.958 0 012.766-4.316m1.914-1.4A9.956 9.956 0 0112 5c4.477 
      0 8.268 2.943 9.542 7a9.982 9.982 0 01-4.254 5.616M15 12a3 
      3 0 11-6 0 3 3 0 016 0z"
    />
    <path
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M3 3l18 18"
    />
  </svg>
</button>

  <InputError class="mt-2" :message="form.errors.password" />
</div>

                        <!-- Remember Me -->
                        <div class="flex items-center space-x-2">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="text-sm text-gray-600">Remember me on this computer</span>
                        </div>

                        <!-- Submit -->
                        <PrimaryButton
                        class="login-btn"
                        :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                        :disabled="form.processing"
                        >
                        LOG IN
                        </PrimaryButton>

                        <!-- Forgot Password -->
                        <div class="text-center mt-2">
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-[#FF4340] text-sm hover:underline"
                            >
                                Forgot Password?
                            </Link>
                        </div>

                        <!-- Status Message -->
                        <div v-if="status" class="text-sm font-medium text-danger mt-4 text-center">
                            {{ status }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
.login-btn {
  width: 100%;
  background-color: #008CA2;
  color: #FFF;
  display: flex;                
  justify-content: center;     
  align-items: center;         
  font-family: "Work Sans", sans-serif;
  font-size: 16px;
  font-style: normal;
  font-weight: 500;
  line-height: 16px;
  text-transform: uppercase;
  padding: 0.75rem 1rem;
  border-radius: 0.5rem;
  transition: background-color 0.3s ease;
  text-align: center;
  cursor: pointer;
}
.login-btn:hover {
  background-color: #00778B;
}


</style>
