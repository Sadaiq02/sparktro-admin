<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <GuestLayout>
        <Head title="Password Reset Successful" />

        <div class="min-h-screen bg-[#F8F8F8] flex items-center justify-center px-4 py-12">
            <div class="bg-white rounded-2xl shadow-lg px-6 sm:px-12 py-12 w-full max-w-md text-center">
                <!-- Logo -->
                <div class="mb-6 flex justify-start">
                    <Link href="/" aria-label="Home">
                        <ApplicationLogo class="h-10 w-auto" />
                    </Link>
                </div>

                <!-- Success Icon -->
                <img
                    src="/assets/img/successful.png"
                    alt="Success"
                    class="mx-auto w-24 h-24 mb-6"
                />

                <!-- Heading -->
                <h2 class="text-2xl font-semibold text-[#1E1E1E]">Successfully</h2>
                <p class="text-sm text-gray-500 mt-2">
                    Your password has been reset successfully
                </p>

                <!-- Button -->
                <Link
                    href="/login"
                    class="mt-6 inline-block w-full bg-[#0A97B0] hover:bg-[#00778B] py-3 rounded-lg transition-all duration-300 ease-in-out text-white disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    <span class="button-text">Continue Login</span>
                </Link>
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
