// const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}',
        "./src/**/*.{html,js,svelte,ts}",
        "./node_modules/flowbite-svelte/**/*.{html,js,svelte,ts}",
    ],

    theme: {
        theme: {
            colors: {
              gray: colors.gray,
              blue: colors.blue,
              red: colors.rose,
              pink: colors.fuchsia,
            },
            fontFamily: {
              sans: ['Graphik', 'sans-serif'],
              serif: ['Merriweather', 'serif'],
            },
            extend: {
              spacing: {
                '128': '32rem',
                '144': '36rem',
              },
              borderRadius: {
                '4xl': '2rem',
              }
            }
          }
        },

    darkMode: 'class',

    plugins: [require('@tailwindcss/forms'), ('flowbite/plugin')],
};

// module.exports = config;
