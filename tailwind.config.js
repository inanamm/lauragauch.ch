const defaultTheme = require("tailwindcss/defaultTheme");

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
      fontSize: {
        ...defaultTheme.fontSize,
        sm: [
          "0.95rem",
          {
            lineHeight: "1.35rem",
            letterSpacing: "0.1rem",
          },
        ],
        base: [
          "1rem",
          {
            lineHeight: "1.35rem",
            letterSpacing: "0.055rem",
          },
        ],
        lg: [
          "1.65rem",
          {
            lineHeight: "1.9rem",
            letterSpacing: "0.03rem",
          },
        ],
      },
    },
  },
  variants: {},
  plugins: [
    require('tailwindcss-opentype'),
  ],

}; 