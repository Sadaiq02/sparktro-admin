import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import colors from "tailwindcss/colors"; // Import default Tailwind colors

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    safelist: ["bg-[#0A97B0]"], // Keep this if you need to dynamically generate this class

    theme: {
        extend: {
            fontFamily: {
                sans: ["'Work Sans'", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gray: {
                    sparktro: "#F1F1F1",
                },
                primary: {
                    50: '#E6F4F7',
                    100: '#CDE9ED',
                    200: '#9AD3DE',
                    300: '#67BDCE',
                    400: '#34A7BE',
                    500: '#0A97B0',
                    600: '#087A90',
                    700: '#065D6C',
                    800: '#044048',
                    900: '#022324',
                    sparktro: "#0A97B0",
                },
                black: {
                    sparktro: "#1E2533",
                },
                red: {
                    sparktro: "#FF4340",
                },
                yellow: {
                    sparktro: "#FDCB02",
                },
                textTeal: {
                    sparktro: "#5BD1D7",
                },
                blue: colors.blue,
                green: colors.green,
                purple: colors.purple,
            },
            borderColor: {
                'gray-sparktro': '#E5E7EB',
            }
        },
    },

    plugins: [forms],
};
