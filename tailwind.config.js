import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    safelist: ["bg-[#0A97B0]"],
    theme: {
        extend: {
            fontFamily: {
                sans: ["'Work Sans'", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'sparktro-gray': '#F1F1F1',
                'sparktro-primary': '#0A97B0',
                'sparktro-black': '#1E2533',
                'sparktro-red': '#FF4340',
            },
        },
    },

    plugins: [forms],
};
