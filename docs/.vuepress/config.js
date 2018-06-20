const tailwindcss = require("tailwindcss");

module.exports = {
  title: "Stage Right Labs",
  head: [["link", { rel: "icon", href: "/favicon-96x96.png" }]],
  postcss: {
    plugins: [
      tailwindcss("docs/.vuepress/tailwind.js"),
      require("autoprefixer")
    ]
  }
};
