import Icon from "vue-awesome/components/Icon";
import Layout from "./theme/Layout.vue";

export default ({
  Vue, // the version of Vue being used in the VuePress app
  options, // the options for the root Vue instance
  router, // the router instance for the app
  siteData // site metadata
}) => {
  // Register third party plugins
  Vue.component('icon', Icon);

  // Register URL Redirects
  // router.addRoutes([{ path: "/blog/", redirect: "/" }]);
  router.addRoutes([{ path: "/blog", component: Layout }]);
  router.addRoutes([{ path: "/contact", component: Layout }]);
};
