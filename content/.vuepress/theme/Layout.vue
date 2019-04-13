<template>
  <div>
    <navigation />
    <component
      :is="$page.frontmatter.layout"
      v-if="$page.frontmatter.layout"
    />
    <blog-index v-else-if="showIndexPage" />
    <colophon />
  </div>
</template>

<script>
import About from './components/About.vue';
import Contact from './components/Contact.vue';
import Colophon from './components/Colophon.vue';
import Projects from './components/Projects.vue';
import BlogPost from './components/BlogPost.vue';
import BlogIndex from './components/BlogIndex.vue';
import Navigation from './components/Navigation.vue';

export default {
  components: { Navigation, Colophon, Projects, Contact, About, BlogIndex, BlogPost },
  computed: {
    showIndexPage() {
      return this.$page.frontmatter.home || this.$route.path == '/blog/' || this.$route.path == '/blog'
    }
  }
}
</script>

<style src="./styles/theme.css"></style>
