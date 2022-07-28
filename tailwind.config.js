const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        letterSpacing: {
            wide: '.1em',
            widest: '.5em',

        },
        colors: {
            'blue': '#1fb6ff',
            'pink': '#ff49db',
            'orange': '#ff7849',
            'green': '#13ce66',
            'gray-dark': '#cbcbcb',
            'gray': {
                100: '#f1f1f1',
                500: '#d1d5db',
            },
            'gray-light': '#d3dce6',
            'black': '#000',
            'white': '#fff',
            'wine':'#981c3e',
            'teal':{
                100:'#e6fffa',
                500:'#38b2ac',
                900:'#234e52',
            },
            'red': {
                50: '#fef2f2',
                100: '#fee2e2',
                200: '#fecaca',
                300: '#fca5a5',
                400: '#f87171',
                500: '#ef4444',
                600: '#dc2626',
                700: '#b91c1c',
                800: '#991b1b',
                900: '#7f1d1d',

            },
        },
        extend: {
            fontFamily: {
                sans: ['Exo', 'serif'],
                serif: ['Bitter']
            },
            backgroundImage: {
                'logo': "url('/img/logo_vb.png')",
                'whats': "url('/img/ico_whats.png')",
                'fb': "url('/img/ico_whats.png')",
                'insta': "url('/img/ig_color.png')",
                'fb': "url('/img/fb_color.png')",
                'tw': "url('/img/tw_color.png')",
                'tt': "url('/img/tt_color.png')",
                'yt': "url('/img/yt_color.png')",
                'security': "url('/img/security.png')",
            },
            boxShadow: {
                '3xl': '10px 10px 20px 0 rgba(0, 0, 0, 0.3)',
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
