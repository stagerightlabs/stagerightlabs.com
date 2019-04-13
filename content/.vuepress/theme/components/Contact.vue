<template>
  <div class="lg:flex container mx-auto">
    <main class="block lg:w-4/5 my-4 ml-4 mr-2 p-6 bg-white shadow-md overflow-x-auto">
      <h2 class="text-2xl">Contact</h2>
      <section class="w-full flex flex-wrap mt-8">
        <div class="w-full md:w-1/2 mb-8">
          <a
            href="https://github.com/srlabs"
            class="text-black flex flex-col items-center"
          >
            <icon
              name="brands/github"
              scale="7"
              class="mb-4"
            />
            github
          </a>
        </div>
        <div class="w-full md:w-1/2 mb-8">
          <a
            href="https://gitlab.com/stage-right-labs"
            class="text-black flex flex-col items-center"
          >
            <icon
              name="brands/gitlab"
              scale="7"
              class="mb-4"
            />
            gitlab
          </a>
        </div>
        <div class="w-full md:w-1/2 flex flex-col items-center mb-8 text-black">
          <a
            href="https://www.linkedin.com/in/rydurham"
            class="text-black flex flex-col items-center"
          >
            <icon
              name="brands/linkedin"
              scale="7"
              class="mb-4"
            />
            linkedin
          </a>
        </div>
        <div class="w-full md:w-1/2 flex flex-col items-center mb-8 text-black">
          <icon
            name="regular/envelope"
            scale="7"
            class="mb-4"
          />
          ryan at stagerightlabs dot com
        </div>
      </section>
    </main>
    <sidebar />
  </div>
</template>

<script>
import Icon from 'vue-awesome/components/Icon';
import 'vue-awesome/icons/regular/envelope';
import 'vue-awesome/icons/brands/linkedin';
import 'vue-awesome/icons/brands/github';
import 'vue-awesome/icons/brands/gitlab';
import Sidebar from './Sidebar.vue'
export default {
  components: { Icon, Sidebar }
}
</script>
