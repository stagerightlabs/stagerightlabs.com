<template>
  <aside class="w-full md:w-64 md:flex-no-shrink">
    <section class="m-4 px-2 py-4 bg-white shadow-md">
      <ul class="mb-4 pb-2 border-b border-gray-300">
        <li class="text-xl px-2 py-1">
          Home
        </li>
        <li class="text-xl px-2 py-1">
          About
        </li>
        <li class="text-xl px-2 py-1">
          Projects
        </li>
        <li class="text-xl px-2 py-1">
          Contact
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
        this.$router.push({query: { category: ''}})
      } else {
        this.$router.push({ query: { category } })
      }
    },
  }
}
</script>

<style scoped>

</style>
