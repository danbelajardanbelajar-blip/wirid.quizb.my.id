/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./app/Views/**/*.html",
    "./assets/js/**/*.js",
    "./index.php",
    "./*.html",
    "./*.php"
  ],
  darkMode: ['selector', '[data-theme="dark"]'],
  theme: {
    extend: {
      colors: { 
        brand: '#10b981',
        panelDark: '#0a1128',
        panelLight: '#ffffff',
        cardDark: 'rgba(15,23,50,.65)'
      }
    }
  },
  plugins: [],
}
