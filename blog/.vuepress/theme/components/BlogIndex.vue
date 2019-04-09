<template>
  <div class="md:flex">
    <main class="block md:flex-1 my-4 ml-4 mr-2 p-4 bg-white shadow-md">
      <h2
        v-if="selectedCategory"
        class="mb-4"
      >
        "{{ selectedCategory }}" Blog Posts
      </h2>

      <!-- Blog post list -->
      <article
        v-for="post in paginatedPosts"
        :key="post.path"
        class="mb-6 mx-0"
      >
        <h2>
          <a
            class="cursor-pointer text-2xl"
            @click="$router.push({path: post.path})"
          >
            {{ post.title }}
          </a>
        </h2>
        <p>
          <span v-html="excerpt(post)" />
          <a
            class="cursor-pointer"
            aria-label="Read More"
            @click="$router.push({path: post.path})"
          >
            <small>More</small> &raquo;
          </a>
        </p>
      </article>

      <!-- Pagination -->
      <nav
        v-if="pageCount > 1"
        class="pagination my-8 pt-8 flex justify-around"
        aria-label="Pagination Navigation"
        role="navigation"
      >
        <span>
          <a
            :class="[paginationBackwardAllowed ? 'cursor-pointer' : 'cursor-not-allowed opacity-25']"
            :aria-label="[paginationBackwardAllowed ? `Go to page ${pageNumber - 1}` : 'disabled']"
            :title="[paginationBackwardAllowed ? `Go to page ${pageNumber - 1}` : '']"
            class="flex items-center"
            @click="previousPage"
          >
            <icon
              name="long-arrow-alt-left"
              class="mr-2"
              scale="2"
            />
          </a>
        </span>
        <span>
          <a
            :class="[paginationForwardAllowed ? 'cursor-pointer' : 'cursor-not-allowed opacity-25']"
            :aria-label="[paginationForwardAllowed ? `Go to page ${pageNumber + 1}` : 'disabled']"
            :title="[paginationForwardAllowed ? `Go to page ${pageNumber + 1}` : '']"
            class="flex items-center"
            @click=" nextPage "
          >
            <icon
              name="long-arrow-alt-right"
              class="ml-2"
              scale="2"
            />
          </a>
        </span>
      </nav>

      <!-- Topic List -->
    </main>
    <sidebar />
  </div>
</template>

<script>
import 'vue-awesome/icons/long-arrow-alt-right';
import 'vue-awesome/icons/long-arrow-alt-left';
import Sidebar from './Sidebar.vue';
import Icon from 'vue-awesome/components/Icon';
import compareDesc from 'date-fns/compare_desc';

export default {
  components: { Icon, Sidebar },
  computed: {
    posts () {
      let posts = this.$site.pages.filter(function (page) {
        return page.frontmatter.layout === 'BlogPost'
      }).sort((a,b) =>  compareDesc(a.frontmatter.date, b.frontmatter.date));

      if (this.selectedCategory) {
        posts = posts.filter((post) => {
          return post.frontmatter.tags
            .map((category) => category.toLowerCase())
            .includes(this.selectedCategory.toLowerCase());
        });
      }

      return posts;
    },
    paginatedPosts () {
      const start = (this.pageNumber - 1) * 5;
      const end = start + 5;
      return this.posts.slice(start, end);
    },
    pageNumber () {
      let pageNumber = this.$route.query.page || 1;
      if (pageNumber > this.pageCount) {
        pageNumber = this.pageCount;
      }
      if (pageNumber < 1) {
        pageNumber = 1;
      }
      return pageNumber;
    },
    pageCount () {
      return Math.ceil(this.posts.length / 5);
    },
    paginationForwardAllowed () {
      return this.pageNumber < this.pageCount;
    },
    paginationBackwardAllowed () {
      return this.pageNumber > 1;
    },
    selectedCategory () {
      return this.$route.query.category || null
    }
  },
  methods: {
    nextPage () {
      let nextPage = this.pageNumber + 1;

      if (nextPage > this.pageCount) {
        nextPage = this.pageCount
      }

      let query = { page: nextPage };

      if (this.selectedCategory) {
        query.category = this.selectedCategory;
      }

      this.$router.push({query})
    },

    previousPage () {
      let previousPage = this.pageNumber - 1;

      if (previousPage < 1) {
        previousPage = 1;
      }

      let query = { page: previousPage };

      if (this.selectedCategory) {
        query.category = this.selectedCategory;
      }

      this.$router.push({query})
    },
    excerpt(post) {
      return post.excerpt.replace(/(<([^>]+)>)/ig,"");
    }
  },
}
</script>

<style scoped>
a {
  @apply .text-red-800;
}
</style>
