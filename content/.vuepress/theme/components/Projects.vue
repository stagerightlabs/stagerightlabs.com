<template>
  <div class="lg:flex container mx-auto">
    <main class="block lg:w-4/5 my-4 ml-4 mr-2 p-6 bg-white shadow-md overflow-x-auto">
      <h2 class="text-2xl">Open Source Projects</h2>
      <section class="w-full flex flex-wrap my-0 md:my-8 mt-8">
        <div class="w-full md:w-1/2 flex flex-col items-center text-center mb-8 text-black">
          <h2 class="text-xl mb-4">
            <a href="https://github.com/stagerightlabs/Centaur">
              Centaur
            </a>
          </h2>
          <p class="leading-normal">
            An opinionated implementation of Cartalyst Sentinel for Laravel 5
          </p>
        </div>
        <div class="w-full md:w-1/2 flex flex-col items-center text-center mb-8 text-black">
          <h2 class="text-xl mb-4">
            <a href="https://github.com/stagerightlabs/eloquent-sti">
              Eloquent STI
            </a>
          </h2>
          <p class="leading-normal">
            Extend Eloquent models with Single Table Inheritance
          </p>
        </div>
      </section>
      <section class="w-full flex flex-wrap my-0 md:my-8">
        <div class="w-full md:w-1/2 flex flex-col items-center text-center mb-8 text-black">
          <h2 class="text-xl mb-4">
            <a href="https://github.com/stagerightlabs/piwik-plugin">
              Matomo/Piwik for October CMS
            </a>
          </h2>
          <p class="leading-normal">
            A plugin for October CMS that provides Piwik Analytics tracking code.
          </p>
        </div>
        <div class="w-full md:w-1/2 flex flex-col items-center text-center mb-8 text-black">
          <h2 class="text-xl mb-4">
            <a href="https://github.com/stagerightlabs/parley">
              Parley
            </a>
          </h2>
          <p class="leading-normal">
            Polymorphic messaging for Laravel
          </p>
        </div>
      </section>
      <section class="w-full flex flex-wrap my-0 md:my-8">
        <div class="w-full md:w-1/2 flex flex-col items-center text-center mb-8 text-black">
          <h2 class="text-xl mb-4">
            <a href="https://github.com/stagerightlabs/Laravel-Form-Validator">
              Laravel Form Validatior
            </a>
          </h2>
          <p class="leading-normal">
            Easy form validation for Laravel 4
          </p>
        </div>
        <div class="w-full md:w-1/2 flex flex-col items-center text-center mb-8 text-black" />
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
