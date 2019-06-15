<template>
  <div>
    <navigation />
    <blog-index v-if="showIndexPage" />
    <component
      :is="$page.frontmatter.layout"
      v-if="$page.frontmatter.layout"
    />
    <colophon />
  </div>
</template>

<script>
import About from '../components/About.vue';
import Decks from '../components/Decks.vue';
import Contact from '../components/Contact.vue';
import Colophon from '../components/Colophon.vue';
import Projects from '../components/Projects.vue';
import BlogPost from '../components/BlogPost.vue';
import BlogIndex from '../components/BlogIndex.vue';
import Navigation from '../components/Navigation.vue';

export default {
  components: {
    About,
    BlogIndex,
    BlogPost,
    Colophon,
    Contact,
    Decks,
    Navigation,
    Projects,
  },
  computed: {
    showIndexPage() {
      return this.$page.frontmatter.home || this.$route.path == '/blog/' || this.$route.path == '/blog'
    }
  }
}
</script>

<style src="../styles/theme.css"></style>
