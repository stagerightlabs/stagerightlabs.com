<template>
  <main class="flex mt-8 mx-8">
    <section class="w-4/5">
      <h2>
        <span v-if="selectedCategory">Cateory: {{ selectedCategory }}</span>
        <span v-else>Blog</span>
      </h2>
      <article v-for="post in paginatedPosts" class="mt-8 mx-8">
        <h2>
          <a :href="post.path">{{ post.title }}</a>
        </h2>
        <p class="mt-4" v-html="post.excerpt"></p>
      </article>

      <div class="pagination my-8 flex justify-around" v-if="pageCount > 1">
        <span>
          <a @click="previousPage" :class="[paginationBackwardAllowed ? 'cursor-pointer' : 'cursor-not-allowed']">Newer</a>
        </span>
        <span>
          <a @click=" nextPage " :class="[paginationForwardAllowed ? 'cursor-pointer' : 'cursor-not-allowed'] ">Older</a>
        </span>
      </div>
    </section>

    <aside class="w-1/5 pl-8">
      <h3>Topics</h3>
      <ul class="mt-4 list-reset ">
        <li v-for="category in categories" class="mt-3">
          <a class="cursor-pointer" @click="goToCategory(category)">{{ category }}</a>
        </li>
      </ul>
    </aside>
  </main>
</template>

<script>
export default {
  methods: {
    nextPage () {
      let nextPage = this.pageNumber + 1;

      if (nextPage > this.pageCount) {
        nextPage = this.pageCount
      }

      this.$router.push({ query: { page: nextPage } })
    },

    previousPage () {
      let previousPage = this.pageNumber - 1;

      if (previousPage < 1) {
        previousPage = 1;
      }

      this.$router.push({ query: { page: previousPage } })
    },
    goToCategory (category) {
      this.$router.push({ query: { category } })
    }
  },
  computed: {
    posts () {
      let posts = this.$site.pages.filter(function (page) {
        return page.frontmatter.layout === 'BlogPost'
      })
        .sort((a, b) => a.frontmatter.date < b.frontmatter.date);

      if (this.selectedCategory) {
        posts = posts.filter((post) => {
          return post.frontmatter.categories
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
      return Math.floor(this.posts.length / 5);
    },
    paginationForwardAllowed () {
      return this.pageNumber < this.pageCount;
    },
    paginationBackwardAllowed () {
      return this.pageNumber > 1;
    },
    categories () {
      return this.$site.pages
        .reduce((categories, page) => categories.concat(page.frontmatter.categories), [])
        .filter((element, index, array) => array.indexOf(element) == index)
        .filter((category) => category);
    },
    selectedCategory () {
      return this.$route.query.category || null
    }
  }
}
</script>

<style>
</style>
