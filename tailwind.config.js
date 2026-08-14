import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Vazirmatn', 'sans-serif'],
                'tech-label': ['"JetBrains Mono"', 'monospace'],
            },
            colors: {
                // رنگ‌های اختصاصی سایت آرمان گستر
                paper: '#F5F2EB',
                graphite: '#1C2024',
                amber: '#F5A623',
                crimson: '#C1381F',
                steel: '#2A2E35',
            },
        },
    },

    plugins: [],
};