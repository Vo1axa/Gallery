/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        monoton: ['Monoton', 'sans-serif'],
        split: ['Split', 'sans-serif'],
        hHachimaki: ['hHachimaki', 'sans-serif'],
        BebasNeue: ['BebasNeue', 'sans-serif'],
        barlow: ['Barlow Condensed', 'serif'],
      },
    },
  },
  plugins: [],
};
