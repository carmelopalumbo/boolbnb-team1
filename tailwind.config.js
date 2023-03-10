// const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./src/**/*.{html,js,svelte,ts}",
        "./node_modules/flowbite-svelte/**/*.{html,js,svelte,ts}",
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}',
        "./pages/**/*.{js,ts,jsx,tsx}",
        "./components/**/*.{js,ts,jsx,tsx}",
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
        "./node_modules/flowbite/**/*.js"
        // "./node_modules/flowbite/**/*.js",
    ],
    // safelist: [
    //     ['animate-[fade-in_1s_ease-in-out]', 'animate-[fade-in-down_1s_ease-in-out]'],
    //   ],

    theme: {
        // colors: {
        //     gray: colors.gray,
        //     blue: colors.blue,
        //     red: colors.rose,
        //     pink: colors.fuchsia,
        //     cyan: colors.cyan,
        // },
        fontFamily: {
            sans: ['Poppins', 'sans-serif'],
            serif: ['Merriweather', 'serif'],
        },
        extend: {
            // spacing: {
            // '128': '32rem',
            // '144': '36rem',
            // },
            borderRadius: {
            '4xl': '2rem',
            },
        },
        container: {
            center: true,
            },
    },

    darkMode: 'class',

    plugins: [require('@tailwindcss/forms'), ('flowbite/plugin')],
};

// module.exports = config;
