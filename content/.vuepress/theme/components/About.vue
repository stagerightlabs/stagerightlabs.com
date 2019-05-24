<template>
  <div class="lg:flex container mx-auto">
    <main class="block lg:w-4/5 my-4 ml-4 mr-2 p-6 bg-white shadow-md overflow-x-auto">
      <h2 class="text-2xl">About</h2>
      <article class="mt-8 text-center">
        <img :src="$withBase('/headshot.png')" alt="headshot" class="mx-auto mb-8 rounded-full">
        <Content />
      </article>
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
