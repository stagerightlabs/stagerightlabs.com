<template>
  <main class="block mt-8 mx-8">
    <h2 class="w-full my-8 text-black">Contact</h2>
    <section class="w-full flex flex-wrap">
      <div class="w-full md:w-1/3 mb-8">
        <a href="https://github.com/srlabs" class="text-black hover:text-red flex flex-col items-center">
          <icon name="github-alt" scale="7" class="mb-4"></icon>
          github
        </a>
      </div>
      <div class="w-full md:w-1/3 mb-8">
        <a href="https://gitlab.com/stage-right-labs" class="text-black hover:text-red flex flex-col items-center">
          <icon name="gitlab" scale="7" class="mb-4"></icon>
          gitlab
        </a>
      </div>
      <div class="w-full md:w-1/3 flex flex-col items-center mb-8 text-black">
        <icon name="envelope-o" scale="7" class="mb-4"></icon>
        ryan at stagerightlabs dot com
      </div>
    </section>
  </main>
</template>

<script>
import 'vue-awesome/icons/envelope-o';
import 'vue-awesome/icons/github-alt';
import 'vue-awesome/icons/gitlab';
export default {

}
</script>
