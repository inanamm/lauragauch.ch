module.exports = {
  content: [
    'site/templates/**/*.php',
    'site/snippets/**/*.php',
  ],
  darkMode: "class",
  theme: {
    extend: {
      fontFamily: {
        sans: ["GeigyLLRegular", "sans-serif"],
        serif: ["TimesTen", "serif"],
      },
    },
  },
  variants: {},
  plugins: [
    require('tailwindcss-opentype'),
  ],

}; 