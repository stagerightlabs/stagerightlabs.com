const PurgecssPlugin = require("purgecss-webpack-plugin");
const tailwindcss = require("tailwindcss");
const glob = require("glob-all");
const path = require("path");

// Custom PurgeCSS extractor for Tailwind that allows special characters in
// class names.
//
class TailwindExtractor {
  static extract(content) {
    return content.match(/[A-z0-9-:\/]+/g) || [];
  }
}

module.exports = {
  title: "Stage Right Labs",
  postcss: {
    plugins: [
      tailwindcss("docs/.vuepress/tailwind.js"),
      require("autoprefixer")
    ]
  },
  configureWebpack: {
    plugins: [
      new PurgecssPlugin({
        // Specify the locations of any files you want to scan for class names.
        paths: glob.sync([
          path.join(__dirname, "./theme/**/*.vue"),
          path.join(__dirname, "./components/**/*.vue")
        ]),
        extractors: [
          {
            extractor: TailwindExtractor,

            // Specify the file extensions to include when scanning for
            // class names.
            extensions: ["vue"]
          }
        ]
      })
    ]
  }
};
