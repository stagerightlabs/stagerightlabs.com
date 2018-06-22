<template>
  <div class="container mx-auto">
    <home v-if="$page.frontmatter.home"></home>
    <template v-else>
      <navigation></navigation>
      <div class="custom-layout" v-if="$page.frontmatter.layout">
        <component :is="$page.frontmatter.layout" />
      </div>
      <blog v-else-if="$route.path == '/blog/'"></blog>
      <contact v-else-if="$route.path == '/contact/'"></contact>
      <colophon></colophon>
    </template>
  </div>
</template>

<script>
import Navigation from '../components/Navigation.vue';
import Colophon from '../components/Colophon.vue';
import Contact from '../components/Contact.vue';
import Blog from '../components/Blog.vue';
import Home from '../components/Home.vue';

export default {
  components: { Navigation, Colophon, Contact, Blog, Home }
}
</script>

<style src="./theme.css"></style>
