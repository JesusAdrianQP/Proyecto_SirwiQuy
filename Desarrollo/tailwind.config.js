const { colors } = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [],
  theme: {
    extend: {
      colors: {
        primary: colors.teal,
      },
    },
  },
  variants: {
    borderWidth: ['responsive', 'hover', 'focus'],
    borderStyle: ['responsive', 'hover', 'focus'],
  },
  plugins: [require('@tailwindcss/ui')],
};
