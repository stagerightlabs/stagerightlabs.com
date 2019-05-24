const tailwindcss = require("tailwindcss");
const nodeExternals = require('webpack-node-externals');

module.exports = {
  title: "Stage Right Labs",
  head: [
    // Theme colors
    ['meta', { name: 'theme-color', content: '#ff2e2e'}],
    ['meta', { name: 'msapplication-navbutton-color', content: '#ff2e2e'}],
    ['meta', { name: 'apple-mobile-web-app-status-bar-style', content: '#ff2e2e'}],
    // Favicon
    ["link", { rel: "icon", href: "/favicon.ico" }],
    // Matomo tracking script
    [
      "script",
      { type: "text/javascript" },
      `
  var _paq = window._paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//stats.stagerightlabs.com/";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
    `
    ]
  ],
  plugins: [
    [require('./theme/plugins/snippets.js')],
    ['@vuepress/last-updated'],
    ['autometa', {
      site: {
        name: 'Stage Right Labs',
        twitter: 'stagerightlabs',
      },
      author: {
        name: 'Ryan C. Durham'
      },
      canonical_base: 'https://stagerightlabs.com',
    }],
    ['sitemap', {
      hostname: 'https://stagerightlabs.com',
      urls: [
        { url: '/decks/single-table-inheritance.html', changefreq: 'montly' },
        { url: '/decks/laravel-101.html', changefreq: 'montly' }
      ]
    }]
  ],
  postcss: {
    plugins: [
      tailwindcss("content/.vuepress/tailwind.config.js"),
      require("autoprefixer")
    ]
  },
  configureWebpack: (config, isServer) => {
    if (isServer) {
      config.externals = [
        // Ensure that webpack knows where to find the vue-awesome icon assets
        // https://github.com/Justineo/vue-awesome/issues/7#issuecomment-322034039
        nodeExternals({
          whitelist: [/\.(?!(?:js|json)$).{1,5}$/i, /^vue-awesome/]
        })
      ]
    }
  },
  themeConfig: {
    author: {
      name: "Ryan C. Durham"
    }
  }
};
