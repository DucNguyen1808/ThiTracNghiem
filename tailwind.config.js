import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                Mlight: "#f8f8fe",
                MgrayLighter: "#f4f4f5",
                Mcontrol:"#f0f0f4",
                Mgray: "#909097",
                Mplanet: "#2e2f3c",
                Msucess: "#19ba63",
                Mwarnings: "#ffc542",
                Merrors: "#f94c4c",
                Minfo: "#3067e4",
                Mblue: "#0745fe",
                MblueRaspberry: "#0091ff",
                MmintGreen: "#34ca79",
                Myellow: "#ffc542",
              },
        },
    },
    plugins: [],
};
