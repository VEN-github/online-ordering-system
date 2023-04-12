/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
  theme: {
    fontFamily: {
      sans: ['Inter', 'sans-serif']
    },
    extend: {}
  },
  plugins: [require('@tailwindcss/forms'), require('prettier-plugin-tailwindcss')]
}
