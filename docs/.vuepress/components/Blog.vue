<template>
  <main class="flex mt-8 mx-8">
    <section class="w-4/5">
      <h2>Blog</h2>
      <article v-for="post in posts" class="mt-8 mx-8">
        <h2>
          <a :href="post.path">{{ post.title }}</a>
        </h2>
        <p class="mt-4" v-html="post.excerpt"></p>
      </article>
    </section>

    <aside class="w-1/5 pl-4">
      <h3>Topics</h3>
      <ul class="mt-4 list-reset">
        <li v-for="category in categories">
          <a href="#">{{ category }}</a>
        </li>
      </ul>
    </aside>
  </main>
</template>

<script>
export default {
  computed: {
    posts () {
      return this.$site.pages.filter(function (page) {
        return page.frontmatter.layout === 'BlogPost'
      })
    },
    categories () {
      return this.$site.pages
        .reduce((categories, page) => categories.concat(page.frontmatter.categories), [])
        .filter((element, index, array) => array.indexOf(element) == index)
        .filter((category) => category);
    }
  }
}
</script>

<style>
</style>
