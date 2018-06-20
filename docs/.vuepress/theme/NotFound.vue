<template>
  <div class="container mx-auto">
    <navigation></navigation>
    <div class="mt-8 text-center">
      <h1 class="my-8 text">404</h1>
      <blockquote class="mb-4">{{ getMsg() }}</blockquote>
      <router-link to="/">Take me home.</router-link>
    </div>
  </div>
</template>

<script>
import Navigation from '../components/Navigation.vue'

const msgs = [
  `There's nothing here.`,
  `How did we get here?`,
  `That's a Four-Oh-Four.`,
  `Looks like we've got some broken links.`
]
export default {
  components: { Navigation },
  methods: {
    getMsg () {
      return msgs[Math.floor(Math.random() * msgs.length)]
    }
  }
}
</script>
