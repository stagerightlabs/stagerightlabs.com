<template>
  <footer class="text-center my-8">
    <p class="text-sm">
      &copy;{{ year }} Stage Right Labs
    </p>
  </footer>
</template>

<script>
export default {
  computed: {
    year () {
      return (new Date()).getFullYear();
    }
  }
}
</script>
