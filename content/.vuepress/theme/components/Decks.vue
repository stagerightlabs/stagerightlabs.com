<template>
  <div class="lg:flex container mx-auto">
    <main class="block lg:w-4/5 my-4 ml-4 mr-2 p-6 bg-white shadow-md overflow-x-auto">
      <h2 class="text-2xl">Presentation Decks</h2>
      <section class="w-full flex flex-wrap my-0 md:my-8 mt-8">
        <Content />
      </section>
    </main>
    <sidebar />
  </div>
</template>

<script>
import Sidebar from './Sidebar.vue'

export default {
  components: { Sidebar }
}
</script>
