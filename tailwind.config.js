import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    // darkMode: "selector",
    content: [
        // "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        // "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./vendor/livewire/flux-pro/stubs/**/*.blade.php",
        "./vendor/livewire/flux/stubs/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Montserrat", ...defaultTheme.fontFamily.sans],
                // sans: ["Inter", ...defaultTheme.fontFamily.sans],
                // display: ["Playfair Display", ...defaultTheme.fontFamily.sans],
                // display: ["Inter", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
