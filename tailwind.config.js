const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config}  */
module.exports = {
    content: [
        'source/**/*.html',
        'source/**/*.md',
        'source/**/*.js',
        'source/**/*.php',
        'source/**/*.vue',
    ],
    important: false,
    mode: 'jit',
    plugins: [
        require("@tailwindcss/aspect-ratio"),
        require("@tailwindcss/forms")({
            strategy: "base",
        }),
        require("@tailwindcss/line-clamp"),
        require("@tailwindcss/typography"),
    ],
    theme: {
        extend: {
            animation: {
                'swing': 'swing 1s infinite',
            },

            keyframes: {
                'swing': {
                    '0%,100%': { transform: 'rotate(15deg)' },
                    '50%': { transform: 'rotate(-15deg)' },
                }
            },
        },
    },
};
