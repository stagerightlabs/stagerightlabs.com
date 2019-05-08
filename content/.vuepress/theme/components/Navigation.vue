<template>
  <header class="masthead">
    <div class="logo">
      <a href="/">
        <h1>
          <span class="text-red-700">S</span>tage
          <span class="text-red-700">R</span>ight
          <span class="text-red-700">L</span>abs
        </h1>
      </a>
    </div>
    <nav aria-label="Main Menu">
      <a
        href="https://github.com/stagerightlabs"
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
