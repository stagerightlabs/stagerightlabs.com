const tailwindcss = require("tailwindcss");

module.exports = {
  title: "Stage Right Labs",
  postcss: {
    plugins: [
      tailwindcss("docs/.vuepress/tailwind.js"),
      require("autoprefixer")
    ]
  }
};
