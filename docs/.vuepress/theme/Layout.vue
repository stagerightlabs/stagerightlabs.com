<template>
  <div class="container mx-auto">
    <navigation></navigation>
    <blog v-if="$page.path == '/'"></blog>
  </div>
</template>

<script>
import Navigation from '../components/Navigation.vue';
import Blog from '../components/Blog.vue';

export default {
  components: { Navigation, Blog }
}
</script>


<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
@import "./theme.scss";
</style>
