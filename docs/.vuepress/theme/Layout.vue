<template>
  <div class="container mx-auto">
    <home v-if="$page.frontmatter.home"></home>
    <div v-else>
      <navigation></navigation>
      <div class="custom-layout" v-if="$page.frontmatter.layout">
        <component :is="$page.frontmatter.layout" />
      </div>
      <blog v-else-if="$route.path == '/blog/'"></blog>
      <colophon></colophon>
    </div>
  </div>
</template>

<script>
import Navigation from '../components/Navigation.vue';
import Colophon from '../components/Colophon.vue';
import Blog from '../components/Blog.vue';
import Home from '../components/Home.vue';

export default {
  components: { Navigation, Colophon, Blog, Home }
}
</script>


<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
@import "./theme.scss";
</style>
