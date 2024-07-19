import preset from "./vendor/filament/support/tailwind.config.preset";
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

export default {
    presets: [preset, require("./vendor/wireui/wireui/tailwind.config.js")],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
                mont: ["Montserrat", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                main: "#2c2c64",
            },
        },
    },

    plugins: [
        forms,
        function ({ addUtilities }) {
            const newUtilities = {
                ".text-stroke": {
                    "-webkit-text-stroke": "1px gray ",
                    color: "transparent",
                },
                ".text-stroke-sm": {
                    "-webkit-text-stroke-width": "1px",
                },
                ".text-stroke-md": {
                    "-webkit-text-stroke-width": "2px",
                },
                ".text-stroke-lg": {
                    "-webkit-text-stroke-width": "3px",
                },
            };

            addUtilities(newUtilities, ["responsive", "hover"]);
        },
    ],
};
