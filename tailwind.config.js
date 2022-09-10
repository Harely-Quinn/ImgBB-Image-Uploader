/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./index.php'],
  theme: {
    extend: {
      width: {
        '66': '186px'
      },
      maxHeight: {
        '75': '300px'
      }
    },
    fontFamily: {
      'pacifico': ['Pacifico', 'cursive']
    },
  },
  plugins: [],
}