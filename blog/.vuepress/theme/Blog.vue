<template>
  <main class="block md:flex mt-8 mx-8">
    <section class="w-full md:w-4/5">

      <h2>
        <span v-if="selectedCategory">Cateory: {{ selectedCategory }}</span>
        <span v-else>Blog</span>
      </h2>

      <!-- Blog post list -->
      <article
        v-for="post in paginatedPosts"
        :key="post.path"
        class="mt-8 mx-0 lg:mx-8"
      >
        <h2>
          <a
            class="cursor-pointer"
            @click="$router.push({path: post.path})"
          >
            {{ post.title }}
          </a>
        </h2>
        <p class="mt-4">
          <span v-html="excerpt(post)"/>
          <a
            class="cursor-pointer"
            @click="$router.push({path: post.path})"
          >
            <icon name="angle-double-right" />
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
            :aria-label="[paginationBackwardAllowed ? `Goto Page ${pageNumber - 1}` : 'disabled']"
            class="flex items-center"
            @click="previousPage"
          >
            <icon
              name="less-than"
              class="mr-2"
              scale="2"
            />
          </a>
        </span>
        <span>
          <a
            :class="[paginationForwardAllowed ? 'cursor-pointer' : 'cursor-not-allowed opacity-25']"
            :aria-label="[paginationForwardAllowed ? `Goto Page ${pageNumber + 1}` : 'disabled']"
            class="flex items-center"
            @click=" nextPage "
          >
            <icon
              name="greater-than"
              class="ml-2"
              scale="2"
            />
          </a>
        </span>
      </nav>
    </section>

    <!-- Topic List -->
    <aside class="w-full md:w-1/5 md:pl-8 text-center md:text-left">
      <h3>Topics</h3>
      <ul class="mt-4 list-reset categories">
        <li
          v-for="category in categories"
          :key="category"
          class="mt-3"
        >
          <a
            :class="{'active': selectedCategory === category}"
            class="cursor-pointer"
            @click="goToCategory(category)"
          >
            {{ category }}
          </a>
        </li>
      </ul>
    </aside>
  </main>
</template>

<script>
import compareDesc from 'date-fns/compare_desc';
import Icon from 'vue-awesome/components/Icon';
import 'vue-awesome/icons/angle-double-right';
import 'vue-awesome/icons/greater-than';
import 'vue-awesome/icons/less-than';

export default {
  components: { Icon },
  computed: {
    posts () {
      let posts = this.$site.pages.filter(function (page) {
        return page.frontmatter.layout === 'BlogPost'
      }).sort((a,b) =>  compareDesc(a.frontmatter.date, b.frontmatter.date));

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
      return Math.ceil(this.posts.length / 5);
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
        .filter((category) => category)
        .sort();
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
    goToCategory (category) {
      if (category === this.selectedCategory) {
        this.$router.push({query: { category: ''}})
      } else {
        this.$router.push({ query: { category } })
      }
    },
    excerpt(post) {
      return post.excerpt.replace(/(<([^>]+)>)/ig,"");
    }
  },
}
</script>
