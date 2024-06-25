/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    prefix: 'tw-',
    theme: {
      container: {
        center: true,
        padding: '20px'
      },
      extend: {
        colors: {
          'mpsb-primary': '#112A46',
          'mpsb-secondary': '#FED767',
          'mpsb-secondary-dark': '#EBBB34',
          'obsidian': '#0B1215'
        }
      }
    },
    plugins: [],
  }
