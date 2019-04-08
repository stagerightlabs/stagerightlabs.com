/**
 * Tailwind Configuration
 */
module.exports = {
  theme: {
    colors: {
      transparent: "transparent",
      black: "#333333",
      gray: "#777777",
      red: "#ff2e2e",
      white: "#fafaf9",
      cream: "#f4f2e9",
    },
    screens: {
      sm: "576px",
      md: "768px",
      lg: "992px",
      xl: "1200px"
    },
    fontFamily: {
      sans: ["'Open Sans'", "sans-serif"],
      // serif: ["serif"],
      mono: ["monospace"]
    },
    fontSize: {
      // xs: ".75rem", // 12px
      sm: ".875rem", // 14px
      base: "1rem", // 16px
      lg: "1.125rem", // 18px
      // xl: "1.25rem" // 20px
      "2xl": "1.5rem", // 24px
      // "3xl": "1.875rem", // 30px
      // "4xl": "2.25rem", // 36px
      "5xl": "3rem" // 48px
    },
    fontWeight: {
      // hairline: 100,
      // thin: 200,
      // light: 300,
      normal: 400,
      // medium: 500,
      // semibold: 600,
      bold: 700
      // extrabold: 800,
      // black: 900
    },

    textColor: theme => theme('colors'),
    backgroundColor: theme => theme('colors'),
    borderWidth: {
      default: "1px",
      "0": "0",
      "2": "2px",
      "4": "4px",
      "8": "8px"
    },
    borderColor: theme => ({
      default: theme ('colors.grey-light'),
      ...theme('colors')
    }),
    width: {
      auto: "auto",
      px: "1px",
      "1": "0.25rem",
      "2": "0.5rem",
      "3": "0.75rem",
      "4": "1rem",
      "6": "1.5rem",
      "8": "2rem",
      "10": "2.5rem",
      "12": "3rem",
      "16": "4rem",
      "24": "6rem",
      "32": "8rem",
      "48": "12rem",
      "64": "16rem",
      "1/2": "50%",
      "1/3": "33.33333%",
      "2/3": "66.66667%",
      "1/4": "25%",
      "3/4": "75%",
      "1/5": "20%",
      "2/5": "40%",
      "3/5": "60%",
      "4/5": "80%",
      "1/6": "16.66667%",
      "5/6": "83.33333%",
      full: "100%",
      screen: "100vw"
    },
    height: {
      auto: "auto",
      px: "1px",
      "1": "0.25rem",
      "2": "0.5rem",
      "3": "0.75rem",
      "4": "1rem",
      "6": "1.5rem",
      "8": "2rem",
      "10": "2.5rem",
      "12": "3rem",
      "16": "4rem",
      "24": "6rem",
      "32": "8rem",
      "48": "12rem",
      "64": "16rem",
      full: "100%",
      screen: "100vh"
    },
    padding: {
      px: "1px",
      "0": "0",
      "1": "0.25rem",
      "2": "0.5rem",
      "3": "0.75rem",
      "4": "1rem",
      "6": "1.5rem",
      "8": "2rem"
    },
    margin: {
      auto: "auto",
      px: "1px",
      "0": "0",
      "1": "0.25rem",
      "2": "0.5rem",
      "3": "0.75rem",
      "4": "1rem",
      "6": "1.5rem",
      "8": "2rem"
    },
  },
  variants: {
    alignContent: ["responsive"],
    alignItems: ["responsive"],
    alignSelf: ["responsive"],
    appearance: ["responsive"],
    backgroundAttachment: [],
    backgroundColor: ["hover"],
    backgroundPosition: [],
    backgroundRepeat: [],
    backgroundSize: [],
    borderColor: ["responsive", "hover"],
    borderRadius: ["responsive"],
    borderStyle: ["responsive"],
    borderWidth: ["responsive"],
    boxShadow: ["responsive"],
    cursor: [],
    display: ["responsive"],
    fill: [],
    flexDirection: ["responsive"],
    flexWrap: ["responsive"],
    flex: ["responsive"],
    flexGrow: ["responsive"],
    flexShrink: ["responsive"],
    float: ["responsive"],
    fontFamily: [],
    fontSize: ["responsive"],
    fontSmoothing: ["responsive", "hover"],
    fontStyle: ["responsive", "hover"],
    fontWeight: [],
    height: ["responsive"],
    inset: ["responsive"],
    justifyContent: ["responsive"],
    letterSpacing: ["responsive"],
    lineHeight: ["responsive"],
    listStylePosition: ["responsive"],
    listStyleType: ["responsive"],
    margin: ["responsive"],
    maxHeight: ["responsive"],
    maxWidth: ["responsive"],
    minHeight: ["responsive"],
    minWidth: ["responsive"],
    negativeMargin: ["responsive"],
    opacity: ["responsive"],
    overflow: ["responsive"],
    padding: ["responsive"],
    pointerEvents: ["responsive"],
    position: ["responsive"],
    resize: ["responsive"],
    stroke: [],
    textAlign: ["responsive"],
    textColor: ["responsive", "hover"],
    textDecoration: ["responsive", "hover"],
    textTransform: ["responsive", "hover"],
    userSelect: ["responsive"],
    verticalAlign: ["responsive"],
    visibility: ["responsive"],
    whitespace: ["responsive"],
    width: ["responsive"],
    wordBreak: ["responsive"],
    zIndex: ["responsive"]
  },
  corePlugins: {

  },
  plugins: [
  ],
};
