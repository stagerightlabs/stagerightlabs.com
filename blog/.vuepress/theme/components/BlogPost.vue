<template>
  <main class="block mt-8 mx-8 my-8">
    <article class="blog-post">
      <header class="mb-6">
        <h1 class="mb-4 leading-normal">
          {{ $page.title }}
        </h1>
        <div
          v-if="$page.frontmatter.categories"
          class="block md:flex md:justify-between"
        >
          <time
            :datetime="publicationTimestamp"
            class="block mb-1"
          >
            {{ publicationDate }}
          </time>
          <span
            v-if="topics.length > 0"
            class="block mb-1"
          >
            <em class="mr-1">
              <span v-if="topics.length > 1">
                Topics:
              </span>
              <span v-else>
                Topic:
              </span>
            </em>
            {{ topics.join(', ') }}
          </span>
        </div>
      </header>
      <aside
        v-if="ageInMonths > 12"
        class="border border-red text-gray-dark bg-cream p-4 my-8 leading-normal text-center"
      >
        This post is more than a year old. I try to keep this content as up-to-date as possible but you may want to consult additional resources.
      </aside>
      <Content :custom="false" />
    </article>
  </main>
</template>

<script>
import format from 'date-fns/format';
import differenceInMonths from 'date-fns/difference_in_months'
import Prism from 'prismjs';
import 'prismjs/components/prism-markup-templating.min';
import 'prismjs/components/prism-verilog.min';
import 'prismjs/components/prism-javascript.min';
import 'prismjs/components/prism-sass.min';
import 'prismjs/components/prism-php.min';
import 'prismjs/components/prism-sql.min';
import 'prismjs/components/prism-css.min';
import 'prismjs/components/prism-bash';
import '../styles/prism.css';

export default {
  computed: {
    publicationTimestamp() {
      return format(this.$page.frontmatter.date);
    },
    publicationDate() {
      return format(this.$page.frontmatter.date, 'MMMM D, YYYY');
    },
    topics() {
      return this.$page.frontmatter.categories || [];
    },
    ageInMonths() {
      return differenceInMonths(new Date(), this.$page.frontmatter.date)
    }
  },
  mounted() {
    Prism.highlightAll();
  }
}
</script>
