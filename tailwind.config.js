/** @type {import('tailwindcss').Config} */

const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: ["./dist/**/*.{php,js}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Roboto"],
      },
    },
  },
};
