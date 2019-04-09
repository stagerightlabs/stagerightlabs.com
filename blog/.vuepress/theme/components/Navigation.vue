<template>
  <header>
    <div class="logo">
      <h1>
        <span class="text-red-600">S</span>tage
        <span class="text-red-600">R</span>ight
        <span class="text-red-600">L</span>abs
      </h1>
    </div>
    <nav aria-label="Main Menu">
      <a
        href="https://github.com/srlabs"
        title="Github"
      >
        <icon
          name="brands/github"
          scale="2"
        />
      </a>
      <a
        href="https://gitlab.com/stage-right-labs"
        class="mx-1 md:mx-4"
        title="Gitlab"
      >
        <icon
          name="brands/gitlab"
          scale="2"
        />
      </a>
    </nav>
  </header>
</template>

<script>
import Icon from 'vue-awesome/components/Icon';
import 'vue-awesome/icons/regular/envelope';
import 'vue-awesome/icons/brands/github';
import 'vue-awesome/icons/brands/gitlab';

export default {
  components: { Icon },
  methods: {
    goTo (path) {
      this.$router.push({ path })
    }
  }
}
</script>

<style scoped>
header {
  @apply flex items-center justify-between items-center border-b-4 border-red-600 p-2;
}

h1 {
  @apply text-2xl;
}

nav {
  @apply text-center;
}

nav a {
  @apply text-gray-500;
}

@screen sm {
  header {
    /* @apply ; */
  }


}

@screen md {
  header {
    @apply p-1;
  }

  nav {
    @apply text-right
  }

  h1 {
    @apply text-5xl;
  }
}

@screen lg {

}


</style>
