const tailwindcss = require("tailwindcss");

module.exports = {
  title: "Stage Right Labs",
  head: [
    // Favicon
    ["link", { rel: "icon", href: "/favicon-96x96.png" }],
    // Matomo tracking script
    [
      "script",
      { type: "text/javascript" },
      `
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//stats.stagerightlabs.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '2']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
    `
    ]
  ],
  postcss: {
    plugins: [
      tailwindcss("docs/.vuepress/tailwind.js"),
      require("autoprefixer")
    ]
  }
};
