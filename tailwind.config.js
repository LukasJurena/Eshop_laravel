import defaultTheme from 'tailwindcss/defaultTheme';
import preset from './vendor/filament/support/tailwind.config.preset'
const Unfonts = require("unplugin-fonts");

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme:
    {
        extend: {
            fontFamily: {
                'Nunito': ['Nunito', 'sans-serif'],
                'NunitoLight': ['NunitoLight', 'sans-serif'],
                'BebasNeue': ['BebasNeue', 'cursive'], 
            }, 
        }, 
    }, 
    plugins: [], 
};