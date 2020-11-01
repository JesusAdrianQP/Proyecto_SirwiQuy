import Typography from "typography";
import WebFont from "webfontloader";

WebFont.load({
  goolge: {
    families: ["Roboto", "Roboto Condensed"]
  }
});

const typography = new Typography({
  baseFontSize: "16px",
  headerFontFamily: [
    "Roboto Condensed",
    "Helvetica Neue",
    "Arial",
    "sans-serif"
  ],
  bodyFontFamily: ["Roboto", "Georgia", "Courier", "monospace"]
});

typography.toString();

typography.injectStyles();

export default typography;
