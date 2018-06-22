<template>
  <div class="container mx-auto">
    <home v-if="$page.frontmatter.home"></home>
    <template v-else>
      <navigation></navigation>
      <component v-if="$page.frontmatter.layout" :is="$page.frontmatter.layout" />
      <blog v-else-if="$route.path == '/blog/'"></blog>
      <contact v-else-if="$route.path == '/contact/'"></contact>
      <projects v-else-if="$route.path == '/projects/'"></projects>
      <colophon></colophon>
    </template>
  </div>
</template>

<script>
import Navigation from './Navigation.vue';
import Colophon from './Colophon.vue';
import Projects from './Projects.vue';
import Contact from './Contact.vue';
import Blog from './Blog.vue';
import Home from './Home.vue';

export default {
  components: { Navigation, Colophon, Projects, Contact, Blog, Home }
}
</script>

<style src="./theme.css"></style>
