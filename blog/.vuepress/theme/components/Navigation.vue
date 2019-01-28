<template>
  <header class="block md:flex border-b-4 border-red md:justify-between md:items-center mx-8 md:mx-auto py-8 text-center lg:text-left">
    <img
      src="../images/logo-h.png"
      class="mx-auto md:mx-8 w-64 lg:w-auto"
      alt="Stage Right Labs logo"
    >
    <nav
      aria-label="Main Menu"
      class="text-center md:text-right mt-2 lg:mt-4 lg:mb-0 text-lg md:text-2xl"
    >
      <a
        class="cursor-pointer text-black hover:text-red mx-3 lg:mx-6"
        aria-label="Go to Home"
        @click="goTo('/')"
      >
        Blog
      </a>
      <a
        class="cursor-pointer text-black hover:text-red mx-3 lg:mx-6"
        aria-label="Goto Projects"
        @click="goTo('/projects')"
      >
        Projects
      </a>
      <a
        class="cursor-pointer text-black hover:text-red mx-3 lg:mx-6"
        aria-label="Goto Contact"
        @click="goTo('/contact')"
      >
        Contact
      </a>
    </nav>
  </header>
</template>

<script>
export default {
  methods: {
    goTo (path) {
      this.$router.push({ path })
    }
  }
}
</script>

<style>
</style>
