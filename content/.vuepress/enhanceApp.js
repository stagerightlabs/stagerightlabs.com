import Layout from "./theme/Layout.vue";

export default ({
  //Vue, // the version of Vue being used in the VuePress app
  //options, // the options for the root Vue instance
  router, // the router instance for the app
  // siteData // site metadata
}) => {
  // Register URL Redirects
  router.addRoutes([{ path: "/blog/", component: Layout }]);
  router.addRoutes([
    { path: "/contact", component: Layout },
    { path: "/projects", component: Layout },
    { path: "/about", component: Layout },
    {
      path: "/projects/parley",
      beforeEnter () {
        window.location = "https://github.com/SRLabs/parley"
      }
    },
    {
      path: "/projects/centaur",
      beforeEnter () {
        window.location = "https://github.com/SRLabs/Centaur"
      }
    },
    {
      path: "/projects/eloquent-sti",
      beforeEnter () {
        window.location = "https://github.com/SRLabs/eloquent-sti"
      }
    },
    {
      path: "/projects/laravel-form-validator",
      beforeEnter () {
        window.location = "http://stagerightlabs.com/projects/laravel-form-validator"
      }
    },
    {
      path: "/projects/piwik-plugin",
      beforeEnter () {
        window.location = "http://octobercms.com/plugin/srlabs-piwik"
      }
    }
  ]);
};
