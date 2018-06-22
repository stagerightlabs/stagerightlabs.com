<template>
  <main class="block mt-8 mx-8 my-8">
    <article class="blog-post">
      <header class="mb-6">
        <h1 class="mb-3">{{ $page.title }}</h1>
        <div v-if="$page.frontmatter.categories" class="flex justify-between">
          <span>{{ publicationDate }}</span>
          <span class="italic">{{ categories }}</span>
        </div>
      </header>
      <Content :custom="false" />
    </article>
  </main>
</template>

<script>
import format from 'date-fns/format';
import Prism from 'prismjs';
import 'prismjs/themes/prism.css';

export default {
  computed: {
    publicationDate() {
      return format(this.$page.frontmatter.date, 'MMMM D, YYYY');
    },
    categories() {
      return this.$page.frontmatter.categories.join(', ');
    }
  },
  mounted() {
    Prism.highlightAll();
  }
}
</script>
