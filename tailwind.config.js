import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    daisyui: {
        themes: ["emerald"],
    },

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    '"Inter Variable", sans-serif',
                    {
                        fontFeatureSettings: '"calt", "liga", "cv08", "cv10", "cv01"'
                    },
                ],
            },
        },
    },

    plugins: [require("daisyui")],
};
