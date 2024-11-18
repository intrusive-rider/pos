import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

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
                sans: ["InterVariable", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require("daisyui"), forms],
};