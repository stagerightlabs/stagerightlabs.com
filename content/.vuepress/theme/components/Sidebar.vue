<template>
  <aside class="block w-full lg:w-1/5">
    <section class="m-4 px-2 py-4 bg-white shadow-md">
      <ul class="mb-4 pb-2 border-b border-gray-300">
        <li class="text-xl px-2 py-1">
          <router-link to="/">Home</router-link>
        </li>
        <li class="text-xl px-2 py-1">
          <router-link to="/about">About</router-link>
        </li>
        <li class="text-xl px-2 py-1">
          <router-link to="/projects">Projects</router-link>
        </li>
        <li class="text-xl px-2 py-1">
          <router-link to="/decks">Decks</router-link>
        </li>
        <li class="text-xl px-2 py-1">
          <router-link to="/contact">Contact</router-link>
        </li>
      </ul>

      <h3 class="text-xl px-2">
        Topics
      </h3>
      <ul class="categories mb-4">
        <li
          v-for="category in categories"
          :key="category"
          class="m-1"
        >
          <a
            :class="{'active': selectedCategory === category}"
            class="cursor-pointer p-1 px-2 text-gray-600"
            @click="goToCategory(category)"
          >
            {{ category }}
          </a>
        </li>
      </ul>
    </section>
  </aside>
</template>

<script>
export default {
  computed: {
    categories () {
      return this.$site.pages
        .reduce((categories, page) => categories.concat(page.frontmatter.tags), [])
        .filter((element, index, array) => array.indexOf(element) == index)
        .filter((category) => category)
        .sort();
    },
    selectedCategory () {
      return this.$route.query.category || null
    }
  },
  methods: {
    goToCategory (category) {
      if (category === this.selectedCategory) {
        this.$router.push({ path: '/blog' })
      } else {
        this.$router.push({ path: '/blog', query: { category } })
      }
    },
  }
}
</script>
