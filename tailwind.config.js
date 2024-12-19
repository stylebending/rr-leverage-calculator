/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./css/**/*.css',
    './js/**/*.js',
    './*.php',],
  theme: {
    extend: {},
  },
  plugins: [require('daisyui'),],
  daisyui: {
    themes: ["night"],
  },
}

