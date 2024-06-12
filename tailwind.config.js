/** @type {import('tailwindcss').Config} */

const colors = require('tailwindcss/colors')

module.exports = {
  content: [
    './app/**/*.php',
    './config/**/*.php',
    './resources/**/*.{php,js}',
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: colors.blue,
      },
      fontFamily: {
        'alt': ['"Involve"', 'sans-serif'],
        'antic': ['"Antic Didone"', 'serif'],
        'mea': ['"Mea Culpa"', 'serif'],
      },
      textColor: {
        'body': '#5E5D5A'
      },
      screens: {
        'tablet': '744px',
        'big-tablet': '1000px',
        'laptop': '1366px',
        'desktop': '1920px',
      }
    },
  },
  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
}
