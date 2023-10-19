module.exports = {
  purge: false,
  darkMode: "media",
  theme: {
    colors: {
      gray: "#aaaaaa",
      slate: "#cbd5e1",
      blue: "#4a90e2",
      white: "#fafafa",
      black: "#1a1a1a",
    },
    extend: {
      fontFamily: {
        sans: [
          "Sohne-Buch",
          "Inter",
          "system-ui",
          "-apple-system",
          "BlinkMacSystemFont",
          "Helvetica Neue",
          "Arial",
          "sans-serif",
        ],
        sansBold: ["Sohne-Kraftig"],
        sansLight: ["Sohne-Leicht"],
        serif: ["Sohne-Buch", "Source Serif Pro", "serif"],
      },
      animation: {
        "spin-slow": "spin 3s linear infinite",
      },
      screens: {
        xsm: { min: "325px", max: "640px" },
        mLg: { min: "408px" },
      },
    },
  },
  variants: {},
  plugins: [],
};
