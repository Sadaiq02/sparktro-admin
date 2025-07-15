const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Work Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#0A97B0',
                    light: 'rgba(10, 151, 176, 0.1)',
                },
                success: {
                    DEFAULT: '#0DC46E',
                    light: 'rgba(13, 196, 110, 0.1)',
                },
                danger: {
                    DEFAULT: '#FF4340',
                    light: 'rgba(255, 67, 64, 0.1)',
                },
                gray: {
                    50: '#5F6D7E',
                    700: '#272D37',
                },
                text: {
                    primary: '#1E2533',
                    secondary: '#5A556E',
                    muted: '#8D97A3',
                    body: '#545C66',
                },
                border: {
                    DEFAULT: '#BDC7D3',
                    light: '#D6E2EF',
                },
                bg: {
                    white: '#FFFFFF',
                    light: '#F8FAFC',
                    gray: '#919AA4',
                    secondary: '#AEC7ED',
                },
            },
            spacing: {
                '8': '8px',
                '16': '16px',
            },
            borderRadius: {
                '8': '8px',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
