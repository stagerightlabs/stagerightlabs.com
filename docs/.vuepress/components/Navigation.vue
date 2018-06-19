<template>
  <header class="flex border-b-4 border-red justify-between items-center py-8">
    <img src="../theme/images/logo-h.png" class="px-8" alt="Stage Right Labs logo">
    <nav>
      <a @click="goTo('/blog')" class="cursor-pointer text-black hover:text-red text-2xl mx-6">Blog</a>
      <a href="#" class="text-black hover:text-red text-2xl mx-6">Projects</a>
      <a href="#" class="text-black hover:text-red text-2xl mx-6">Contact</a>
    </nav>
  </header>
</template>

<script>
export default {
  methods: {
    goTo (path) {
      console.log(path)
      this.$router.push({ path })
    }
  }
}
</script>

<style>
</style>
