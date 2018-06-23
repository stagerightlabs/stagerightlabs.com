<template>
  <main class="block mt-8 mx-8 my-8">
    <article class="blog-post">
      <header class="mb-8">
        <h1 class="mb-4 leading-normal">{{ $page.title }}</h1>
        <div
          v-if="$page.frontmatter.categories"
          class="flex justify-between"
        >
          <span>{{ publicationDate }}</span>
          <span v-if="topics.length > 0">
            <em class="mr-1">Topic<span v-if="topics.length > 1">s</span>:</em>
            {{ topics.join(', ') }}
          </span>
        </div>
      </header>
      <Content :custom="false" />
    </article>
  </main>
</template>

<script>
import format from 'date-fns/format';
import Prism from 'prismjs';
import 'prismjs/components/prism-javascript.min';
import 'prismjs/components/prism-sass.min';
import 'prismjs/components/prism-php.min';
import 'prismjs/components/prism-sql.min';
import 'prismjs/components/prism-css.min';
import 'prismjs/components/prism-bash';
import '../theme/prism.css';

export default {
  computed: {
    publicationDate() {
      return format(this.$page.frontmatter.date, 'MMMM D, YYYY');
    },
    topics() {
      return this.$page.frontmatter.categories || [];
    }
  },
  mounted() {
    Prism.highlightAll();
  }
}
</script>
