import Layout from "./theme/Layout.vue";

export default ({
  //Vue, // the version of Vue being used in the VuePress app
  //options, // the options for the root Vue instance
  router, // the router instance for the app
  // siteData // site metadata
}) => {
  // Register URL Redirects
  // router.addRoutes([{ path: "/blog/", redirect: "/" }]);
  router.addRoutes([
    { path: "/contact", component: Layout },
    { path: "/projects", component: Layout },
    {
      path: "/blog/using-tailwind-with-sass-vue-cli-and-wepback",
      redirect: "/blog/using-tailwind-with-sass-vue-cli-and-wepback.html"
    },
    {
      path: "/blog/simplify-validation-messaging-with-blade-directives",
      redirect: "/blog/simplify-validation-messaging-with-blade-directives.html"
    },
    {
      path: "/blog/better-404-logging-in-laravel",
      redirect: "/blog/better-404-logging-in-laravel.html"
    },
    {
      path: "/blog/using-mockery-with-codeception-and-laravel-4",
      redirect: "/blog/using-mockery-with-codeception-and-laravel-4.html"
    },
    {
      path: "/blog/using-lumen-and-madrill-to-process-incoming-mail",
      redirect: "/blog/using-lumen-and-madrill-to-process-incoming-mail.html"
    },
    {
      path: "/blog/laravel5-pacakge-development-setup",
      redirect: "/blog/laravel5-package-development-setup.html"
    },
    {
      path: "/blog/laravel5-pacakge-development-service-provider",
      redirect: "/blog/laravel5-package-development-service-provider.html"
    },
    {
      path: "/blog/single-table-inheritance",
      redirect: "/blog/single-table-inheritance.html"
    },
    {
      path: "/blog/running-homestead-2-on-windows",
      redirect: "/blog/running-homestead-2-on-windows.html"
    },
    {
      path: "/blog/translating-custom-error-messages-laravel",
      redirect: "/blog/translating-custom-error-messages-laravel.html"
    },
    {
      path: "/blog/so-you-want-a-website",
      redirect: "/blog/so-you-want-a-website"
    },
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
