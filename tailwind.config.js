/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/*.blade.php",
    "./resources/js/*.js",
    "./resources/js/componente/*.vue",
    'node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {},
  },
  plugins: [

    require('preline/plugin'),
  ],
}