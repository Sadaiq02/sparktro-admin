<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Newpassword from "@/Components/Newpassword.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="New Password" />

        <div class="min-h-screen bg-[#F8F8F8] flex flex-col md:flex-row items-center justify-center px-4 md:px-12 py-8">
            <!-- Left: Illustration -->
            <div class="hidden md:flex md:w-1/2 justify-center items-center">
                <Newpassword class="max-w-[400px] w-full" />
            </div>

            <!-- Right: Form -->
            <div class="w-full md:w-1/2 flex justify-center">
                <div class="w-full max-w-[480px] bg-white shadow-lg rounded-2xl px-8 sm:px-12 py-10">
                    <!-- Logo -->
                    <div class="mb-6 flex justify-start">
                        <Link href="/" aria-label="Home">
                            <ApplicationLogo class="h-10 w-auto" />
                        </Link>
                    </div>

                    <!-- Heading -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-[#1E1E1E]">New Password</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Set the new password for your account so you can login and access all features.
                        </p>
                    </div>

                    <!-- Form -->
                    <form @submit.prevent="submit" class="space-y-6">
                        <!-- New Password -->
                        <div>
                            <InputLabel for="password" value="New Password" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full placeholder-gray-400"
                                v-model="form.password"
                                placeholder="Minimum 8 symbol at least"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <InputLabel for="password_confirmation" value="Confirm New Password" />
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 block w-full placeholder-gray-400"
                                v-model="form.password_confirmation"
                                placeholder="Minimum 8 symbol at least"
                                required
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password_confirmation" />
                        </div>

                        <!-- Submit -->
                        <button
                            type="submit"
                            class="w-full bg-[#0A97B0] hover:bg-[#00778B] py-3 rounded-lg transition-all duration-300 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed"
                            :disabled="form.processing"
                        >
                            <span class="button-text">Update Password</span>
                        </button>
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

  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
  width: 100%;
}
</style>
