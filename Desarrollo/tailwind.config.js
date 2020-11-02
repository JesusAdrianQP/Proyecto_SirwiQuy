const { colors } = require('tailwindcss/defaultTheme');

module.exports = {
  purge: [],
  theme: {
    extend: {
      colors: {
        primary: colors.indigo,
      },
    },
  },
  variants: {
    borderWidth: ['responsive', 'hover', 'focus'],
    borderStyle: ['responsive', 'hover', 'focus'],
  },
  plugins: [require('@tailwindcss/ui')],
};
