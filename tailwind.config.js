/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                tertiary: "#EAD621",
                primary: "#2029F3",
                success: "#249E2C",
            },
        },
    },
    plugins: [],
};
