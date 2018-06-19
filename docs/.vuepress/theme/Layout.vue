<template>
  <div class="container mx-auto">
    <navigation></navigation>
    <blog v-if="$page.path == '/'"></blog>
    <colophon></colophon>
  </div>
</template>

<script>
import Navigation from '../components/Navigation.vue';
import Colophon from '../components/Colophon.vue';
import Blog from '../components/Blog.vue';

export default {
  components: { Navigation, Colophon, Blog }
}
</script>


<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
@import "./theme.scss";
</style>
