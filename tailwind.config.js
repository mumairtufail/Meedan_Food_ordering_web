import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', 'Poppins', 'Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                base: '#F9F6F1',
                primary: '#014152',
                accent: '#FF9E0D',
            },
        },
    },

    plugins: [forms],
};
