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
            letterSpacing: "0.085rem",
          },
        ],
        md: [
          "1.45rem",
          {
            lineHeight: "1.65rem",
            letterSpacing: "0.03rem",
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
      lineHeight: {
        'extra': '0.75',
      },
    },
  },
  variants: {},
  plugins: [
    require('tailwindcss-opentype'),
    function ({ addBase, theme }) {
      addBase({
        '.dark .text-sm': {
          letterSpacing: "0.105rem",
        },
        '.dark .text-base': {
          letterSpacing: "0.095rem",
        },
        '.dark .text-md': {
          letterSpacing: "0.035rem",
        },
        '.dark .text-lg': {
          letterSpacing: "0.035rem",
        },
      });
    },
    function ({ addUtilities }) {
      const newUtilities = {
        ".no-scrollbar::-webkit-scrollbar": {
          display: "none",
        },
        ".no-scrollbar": {
          "-ms-overflow-style": "none",
          "scrollbar-width": "none",
        },
      };
      addUtilities(newUtilities);
    },
  ],
};
