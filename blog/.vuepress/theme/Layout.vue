<template>
  <div class="container mx-auto">
    <template>
      <navigation />
      <component
        :is="$page.frontmatter.layout"
        v-if="$page.frontmatter.layout"
      />
      <blog-index v-else-if="$page.frontmatter.home" />
      <contact v-else-if="$route.path == '/contact'" />
      <projects v-else-if="$route.path == '/projects'" />
      <colophon />
    </template>
  </div>
</template>

<script>
import Home from './components/Home.vue';
import Contact from './components/Contact.vue';
import Colophon from './components/Colophon.vue';
import Projects from './components/Projects.vue';
import BlogPost from './components/BlogPost.vue';
import BlogIndex from './components/BlogIndex.vue';
import Navigation from './components/Navigation.vue';

export default {
  components: { Navigation, Colophon, Projects, Contact, BlogIndex, BlogPost, Home }
}
</script>

<style src="./styles/theme.css"></style>
