<template>
  <main class="block mt-8 mx-8">
    <h2 class="w-full my-8 text-black">Contact</h2>
    <section class="w-full flex flex-wrap">
      <div class="w-full md:w-1/3 mb-8">
        <a
          href="https://github.com/srlabs"
          class="text-black hover:text-red flex flex-col items-center">
          <icon
            name="brands/github-alt"
            scale="7"
            class="mb-4"/>
          github
        </a>
      </div>
      <div class="w-full md:w-1/3 mb-8">
        <a
          href="https://gitlab.com/stage-right-labs"
          class="text-black hover:text-red flex flex-col items-center">
          <icon
            name="brands/gitlab"
            scale="7"
            class="mb-4"/>
          gitlab
        </a>
      </div>
      <div class="w-full md:w-1/3 flex flex-col items-center mb-8 text-black">
        <icon
          name="regular/envelope"
          scale="7"
          class="mb-4"/>
        ryan at stagerightlabs dot com
      </div>
    </section>
  </main>
</template>

<script>
import * as Icon from 'vue-awesome';
import 'vue-awesome/icons/regular/envelope';
import 'vue-awesome/icons/brands/github-alt';
import 'vue-awesome/icons/brands/gitlab';
export default {
  components: { Icon }
}
</script>
