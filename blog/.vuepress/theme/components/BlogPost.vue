<template>
  <div class="md:flex">
    <main class="block md:flex-1 my-4 ml-4 mr-2 p-6 bg-white shadow-md">
      <article class="blog-post">
        <header class="mb-6">
          <h1>
            {{ $page.title }}
          </h1>
          <div class="flex">
            <time
              :datetime="publicationTimestamp"
              class="block mb-1"
            >
              {{ publicationDate }}
            </time>
            <div
              v-if="topics.length"
              class="block mb-1"
            >
              <span
                v-for="topic in topics"
                :key="topic"
                class="topic"
              >
                {{ topic }}
              </span>
            </div>
          </div>
        </header>
        <aside
          v-if="ageInMonths > 12"
          class="border border-red-700 border-dashed text-sm p-4 mb-4 leading-normal text-center"
        >
          This post is more than a year old; it is possible the content is now a bit out of date.
        </aside>
        <Content :custom="false" />
      </article>
    </main>
    <sidebar />
  </div>
</template>

<script>
import Sidebar from './Sidebar.vue';
import format from 'date-fns/format';
import differenceInMonths from 'date-fns/difference_in_months'

export default {
  components: { Sidebar },
  computed: {
    publicationTimestamp() {
      return format(this.$page.frontmatter.date);
    },
    publicationDate() {
      return format(this.$page.frontmatter.date, 'MMMM D, YYYY');
    },
    topics() {
      return this.$page.frontmatter.tags || [];
    },
    ageInMonths() {
      return differenceInMonths(new Date(), this.$page.frontmatter.date)
    }
  }
}
</script>
