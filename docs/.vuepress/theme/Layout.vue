<template>
  <div class="container mx-auto">
    <navigation></navigation>
    <Content/>
  </div>
</template>

<script>
import Navigation from '../components/Navigation.vue';

export default {
  components: { Navigation }
}
</script>


<style lang="scss">
@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,700");
@import "./theme.scss";
</style>
