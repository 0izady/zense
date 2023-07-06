const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/flowbite/**/*.js"
    ],
    plugins: [
        require('flowbite/plugin'),
        require("daisyui"),
    ],
    daisyui: {
        // themes: ["light"],
        themes: [
            {
              mytheme: {
                "primary": "#fc6600",
                "secondary": "#f97316",
                "accent": "#37cdbe",
                "neutral": "#3d4451",
                "base-100": "#ffffff",
              },
            },
            "light",
          ],
    },
};
