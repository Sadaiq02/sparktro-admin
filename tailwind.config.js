const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                'primary': {
                    DEFAULT: 'var(--primary)',
                    hover: 'var(--primary-hover)',
                    light: 'var(--primary-light)'
                },
                'bg': {
                    white: 'var(--bg-white)',
                    light: 'var(--bg-light)',
                    lighter: 'var(--bg-lighter)',
                    gray: 'var(--bg-gray)',
                },
                'text': {
                    primary: 'var(--text-primary)',
                    secondary: 'var(--text-secondary)',
                    body: 'var(--text-body)',
                    muted: 'var(--text-muted)',
                },
                'border': {
                    DEFAULT: 'var(--border)',
                    light: 'var(--border-light)',
                },
                'success': {
                    DEFAULT: 'var(--success)',
                    light: 'var(--success-light)'
                },
                'warning': {
                    DEFAULT: 'var(--warning)',
                    light: 'var(--warning-light)'
                },
                'danger': {
                    DEFAULT: 'var(--danger)',
                    light: 'var(--danger-light)'
                },
                gray: colors.gray,
            },
            ringColor: ({ theme }) => ({
                DEFAULT: theme('colors.primary.DEFAULT'),
                ...theme('colors'),
            }),
            ringOpacity: {
                DEFAULT: '0.2',
                '20': '0.2',
                '50': '0.5'
            },
            borderRadius: {
                'sm': 'var(--radius-sm)',
                'md': 'var(--radius-md)',
                'lg': 'var(--radius-lg)',
                'xl': 'var(--radius-xl)',
                '2xl': 'var(--radius-2xl)',
                'full': 'var(--radius-full)',
            },
            boxShadow: {
                'sm': 'var(--shadow-sm)',
                'DEFAULT': 'var(--shadow)',
                'md': 'var(--shadow-md)',
                'lg': 'var(--shadow-lg)',
                'card': 'var(--shadow-card)',
                'button': 'var(--shadow-button)',
            },
            fontFamily: {
                sans: ['Work Sans', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                1: 'var(--space-1)',
                2: 'var(--space-2)',
                3: 'var(--space-3)',
                4: 'var(--space-4)',
                5: 'var(--space-5)',
                6: 'var(--space-6)',
                8: 'var(--space-8)',
                10: 'var(--space-10)',
                12: 'var(--space-12)',
            },
            fontSize: {
                xs: 'var(--text-xs)',
                sm: 'var(--text-sm)',
                base: 'var(--text-base)',
                lg: 'var(--text-lg)',
                xl: 'var(--text-xl)',
                '2xl': 'var(--text-2xl)',
            },
            lineHeight: {
                none: 'var(--line-height-none)',
                tight: 'var(--line-height-tight)',
                snug: 'var(--line-height-snug)',
                normal: 'var(--line-height-normal)',
                relaxed: 'var(--line-height-relaxed)',
                loose: 'var(--line-height-loose)',
            },
            transitionProperty: {
                all: 'var(--transition-all)',
                colors: 'var(--transition-colors)',
                opacity: 'var(--transition-opacity)',
                shadow: 'var(--transition-shadow)',
            },
            zIndex: {
                0: 'var(--z-0)',
                10: 'var(--z-10)',
                20: 'var(--z-20)',
                30: 'var(--z-30)',
                40: 'var(--z-40)',
                50: 'var(--z-50)',
                auto: 'var(--z-auto)',
            },
            screens: {
                'xs': '475px',
                ...defaultTheme.screens,
            },
        },
    },
    plugins: [],
};
