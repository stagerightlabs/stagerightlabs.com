@extends('layouts.deck')

@section('title', 'The Secret Power of Renderless Vue Components')

@section('slides')
<section>
  <h1>The Secret Power of Renderless Components</h1>
</section>

<!-- About Me -->
<section>
  <img src="{{ url(asset('img/avatar.jpg')) }}" style="width: 250px"  class="rounded-full" />
  <p>Ryan Durham</p>
  <p style="font-size: 80%;">
    Senior Engineer @ <a href="https://phylos.bio">Phylos</a>
    <br />
    Owner @ <a href="https://stagerightlabs.com">Stage Right Labs</a>
  </p>
  <p style="font-size: 70%;">
    <svg aria-hidden="true" width="31" height="32" focusable="false"
          style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512">
      <path fill="currentColor"
            d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
      </path>
    </svg>
    ryan at stagerightlabs dot com
  </p>
  <p style="font-size: 70%; margin-top:0">
    <svg aria-hidden="true" width="31" height="32" viewBox="0 0 496 512" focusable="false"
          style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg">
      <path
            d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 0.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-0.3 5.6 1.3 5.6 3.6zM134.8 392.9c0.7-2 3.6-3 6.2-2.3 3 0.9 4.9 3.2 4.3 5.2-0.6 2-3.6 3-6.2 2-3-0.6-5-2.9-4.3-4.9zM179 391.2c2.9-0.3 5.6 1 5.9 2.9 0.3 2-1.7 3.9-4.6 4.6-3 0.7-5.6-0.6-5.9-2.6-0.3-2.3 1.7-4.2 4.6-4.9zM244.8 8c138.7 0 251.2 105.3 251.2 244 0 110.9-67.8 205.8-167.8 239-12.7 2.3-17.3-5.6-17.3-12.1 0-8.2 0.3-49.9 0.3-83.6 0-23.5-7.8-38.5-17-46.4 55.9-6.3 114.8-14 114.8-110.5 0-27.4-9.8-41.2-25.8-58.9 2.6-6.5 11.1-33.2-2.6-67.9-20.9-6.6-69 27-69 27-20-5.6-41.5-8.5-62.8-8.5s-42.8 2.9-62.8 8.5c0 0-48.1-33.5-69-27-13.7 34.6-5.2 61.4-2.6 67.9-16 17.6-23.6 31.4-23.6 58.9 0 96.2 56.4 104.3 112.3 110.5-7.2 6.6-13.7 17.7-16 33.7-14.3 6.6-51 17.7-72.9-20.9-13.7-23.8-38.6-25.8-38.6-25.8-24.5-0.3-1.6 15.4-1.6 15.4 16.4 7.5 27.8 36.6 27.8 36.6 14.7 44.8 84.7 29.8 84.7 29.8 0 21 0.3 55.2 0.3 61.4 0 6.5-4.5 14.4-17.3 12.1-99.7-33.4-169.5-128.3-169.5-239.2 0-138.7 106.1-244 244.8-244zM97.2 352.9c1.3-1.3 3.6-0.6 5.2 1 1.7 1.9 2 4.2 0.7 5.2-1.3 1.3-3.6 0.6-5.2-1-1.7-1.9-2-4.2-0.7-5.2zM86.4 344.8c0.7-1 2.3-1.3 4.3-0.7 2 1 3 2.6 2.3 3.9-0.7 1.4-2.7 1.7-4.3 0.7-2-1-3-2.6-2.3-3.9zM118.8 380.4c1.3-1.6 4.3-1.3 6.5 1 2 1.9 2.6 4.9 1.3 6.2-1.3 1.6-4.2 1.3-6.5-1-2.3-1.9-2.9-4.9-1.3-6.2zM107.4 365.7c1.6-1.3 4.2-0.3 5.6 2 1.6 2.3 1.6 4.9 0 6.2-1.3 1-4 0-5.6-2.3-1.6-2.3-1.6-4.9 0-5.9z">
      </path>
    </svg>
    <a href="https://github.com/stagerightlabs">stagerightlabs</a>
  </p>
</section>

<!-- Renderless Components  + Scoped Slots = Game Changer -->
<section>
  <p>
    Scoped Slots + Renderless Components =
  </p>
  <p>
    <strong>Game Changer</strong>
  </p>
</section>

<!-- What is a Scoped slot? -->
<section>
  <h1>What is a "scoped" slot?</h1>
</section>

<!-- What is a regular slot? -->
<section>
  <h2>Slots</h2>
  <p>Slots allow parent components to inject <br />content into child components.</p>
</section>

<!-- Default Slot Example -->
<section>
  <h2>"Default" Slot</h2>
  <table class="side-by-side">
    <tr>
      <td>
        <pre><code class="html" data-trim>
// App.vue - Parent
<template>
<my-component>
<p>Hello World!</p>
</my-component>
</template></code></pre>
      </td>
      <td>
        <pre><code class="html" data-trim>
// MyComponent.vue - Child
<template>
<div>
<header>
<h1>Child Heading</h1>
</header>
<slot></slot>
</div>
</template></code></pre>
      </td>
    </tr>
  </table>
</section>

<!-- Default Slot Rendered -->
<section>
  <h2>"Default" Slot - Result</h2>
  <pre><code class="html" data-trim>
<div>
<header>
<h1>Child Heading</h1>
</header>
<p>Hello World!</p>
</div></code></pre>
</section>

<section>
  <p>What if you want to inject into multiple locations?</p>
</section>

<section>
  <h2>"Named" Slots</h2>
  <p>You can have as many named slots as you want, <br /> in addition to the default slot.</p>
</section>

<!-- Named Slot Example -->
<section>
  <h2>Named Slots</h2>
  <table class="side-by-side">
    <tr>
      <td>
        <pre><code class="html" data-trim>
// App.vue - Parent
<template>
<my-component>
&lt;template v-slot:header&gt;
<h1>Parent Heading</h1>
&lt;/template&gt;
<p>Hello World!</p>
</my-component>
</template></code></pre>
      </td>
      <td>
        @verbatim
        <pre><code class="html" data-trim>
// MyComponent.vue - Child
<template>
<div>
<header>
<slot name="header">
  <h1>Child Heading</h1>
</slot>
</header>
<slot></slot>
</div>
</template></code></pre>
        @endverbatim
      </td>
    </tr>
  </table>
</section>

<!-- Named Slot Result -->
<section>
  <h2>Named Slots - Result</h2>
  <pre><code class="html" data-trim>
<div>
<header>
<h1>Parent Heading</h1>
</header>
<p>Hello World!</p>
</div></code></pre>
</section>

<!-- What if you want to reference child component data? -->
<section>
  <p>What if you want to refer to child component data?</p>
</section>

<!-- Passing parameters to scoped slots -->
<section>
  <h2>Scoped Slots</h2>
  <p>"Scoped" slots have access to child component data.</p>
</section>

<!-- Scoped slot example -->
<section>
  <h2>Scoped Slot Example</h2>
  <table class="side-by-side">
    <tr>
      <td>
        @verbatim
        <pre><code class="html" data-trim>
// App.vue - Parent
<template>
<my-component>
&lt;template #header="slotProps"&gt;
<h1>{{ slotProps.user.name }}</h1>
&lt;/template&gt;
<p>Hello World!</p>
</my-component>
</template>

<!--
There is no user object available
in this component.
-->
        </code></pre>
        @endverbatim
      </td>
      <td>
        @verbatim
        <pre><code class="html" data-trim>
// MyComponent.vue - Child
<template>
<div>
<header>
<slot name="header" :user="user">
  <h1>{{ user.name }}</h1>
</slot>
</header>
<slot></slot>
</div>
</template>

<script>
export default {
data() {
return {
user: { ... },
}
}
}
</script>
        </code></pre>
        @endverbatim
      </td>
    </tr>
  </table>
</section>

<!-- Destructuring data in scoped slots -->
<section>
  <h2>Slot props can be destructured</h2>
  @verbatim
  <pre><code class="html" data-trim>
// App.vue - Parent
<template>
<my-component>
&lt;template #header="{ user }"&gt;
<h1>{{ user.name }}</h1>
&lt;/template&gt;
<p>Hello World!</p>
</my-component>
</template>
  </code></pre>
  @endverbatim
</section>

<!-- The default slot is also a scoped slot -->
<section>
  <h2>This also works with default slots</h2>
  @verbatim
  <pre><code class="html" data-trim>
// App.vue
<template>
<my-component>
&lt;template #header="{ user }"&gt;
<h1>{{ user.name }}</h1>
&lt;/template&gt;
&lt;template #default="{ prop }"&gt;
<p>{{ prop.example }}</p>
&lt;/template&gt;
</my-component>
</template>
  </code></pre>
  @endverbatim
</section>

<!-- Note about slot API change in v2.6 -->
<section>
  <h2>Important Note</h2>
  <p>The slot API we are looking at is from Vue 2.6+.  If you are using an earlier version of Vue things will work exactly the same, but the API is slightly different.</p>
</section>

<!-- What is a renderless component? -->
<section>
  <h2>What is a renderless component?</h2>
</section>

<!-- Standard Vue Component Example -->
<section>
  <h2>Standard Vue Component</h2>
  @verbatim
  <pre>
    <code class="html" data-trim>
// MyComponent.vue
<template>
<div>
<h1>Hello {{ name }}</h1>
</div>
</template>

<script>
export default {
data() {
return {
name: 'World'
}
}
}
</script>

<style></style>
    </code>
  </pre>
  @endverbatim
</section>

<!-- Inline Template Component Example -->
<section>
  <h2>Alternative: Inline Template</h2>
  @verbatim
  <pre>
    <code class="html" data-trim>
<script>
export default {
template: `<div><h1>Hello {{ name }}</h1></div>`,
data() {
return {
name: 'World'
}
}
}
</script>

<style></style>
    </code>
  </pre>
  @endverbatim
</section>

<!-- Render Function Example -->
<section>
  <h2>Alternative: Render Function</h2>
  <pre>
    <code class="html" data-trim>
<script>
export default {
render(createElement) {
return createElement('div', [
createElement('h1', "Hello " + this.name)
])
},
data() {
return {
name: 'World'
}
}
}
</script>

<style></style>
    </code>
  </pre>
</section>

<!-- What is a renderless component? -->
<section>
  <p><code>createElement()</code> generates virtual nodes that will be inserted into Vue's virtual DOM.</p>
</section>

<!-- createElement() parameters -->
<section>
  <h2><code>createElement()</code></h2>
  <pre>
    <code class="js" data-trim>
// @returns {VNode}
createElement(
'div', // String or function that returns a tag name

// {String | Array}
// Children VNodes, built using `createElement()`,
// or using strings to get 'text VNodes'. Optional.
[
'Some text comes first.',
createElement('h1', 'A headline'),
createElement(MyComponent, {
props: {
  someProp: 'foobar'
}
})
]
)
    </code>
  </pre>
  <small><a href="https://vuejs.org/v2/guide/render-function.html#createElement-Arguments">https://vuejs.org/v2/guide/render-function.html</a></small>
  <aside class="notes">
    https://github.com/vuejs/vue/blob/4d4d22a3f6017c46d08b67afe46af43027b06629/src/core/instance/render-helpers/index.js
  </aside>
</section>

<!-- createElement is sometimes called h() -->
<section>
  <code>createElement()</code> is sometimes called <code>h()</code>
</section>

<!-- vue template explorer -->
<section>
  <h2>Vue Template Explorer</h2>
  <p>Use the Template Explorer to see how render functions are generated by Vue behind the scenes:</p>
  <p>
    <a href="https://template-explorer.vuejs.org/">https://template-explorer.vuejs.org/</a>
  </p>
</section>

<!-- What if we combine a render function with a scoped slot? -->
<section>
  <p>What happens when we combine render <br />functions and scoped slots?</p>
</section>

<!-- return the default slot in the render function -->
<section>
  <h2>Render slot content</h2>
  <pre><code class="html" data-trim>
// MyComponent.vue
<script>
export default {
render() {
return this.$scopedSlots.default({
user: this.user
});
},
}
</script>
  </code></pre>
  <p>This is now a "renderless" component.</p>
</section>

<!-- return the default slot in the render function -->
<section>
  <h2>Usage</h2>
  @verbatim
  <pre><code class="html" data-trim>
// App.vue
<template>
<my-component>
&lt;template #default="{ user }"&gt;
<h1>{{ user.name }}</h1>
&lt;/template&gt;
</my-component>
</template>
  </code></pre>
  @endverbatim
</section>

<section>
  <p>"Renderless" components allow us to inject functionality that does not rely on specific UI/UX.</p>
</section>

<!-- Code Sandbox Link -->
<section>
  <h2>Demo</h2>
  <p>Shift + Click Range Selection</p>
  <a href="https://codesandbox.io/s/xoy96vw0o">https://codesandbox.io/s/xoy96vw0o</a>
</section>

<!-- More about slots -->
<section>
  <p>More about slots:</p>
  <p><a href="https://vuejs.org/v2/guide/components-slots.html">https://vuejs.org/v2/guide/components-slots.html</a></p>
</section>

<!-- Advanced Vue Component Design -->
<section>
  <img src="{{ url(asset('img/decks/advanced_vue_component_design.png')) }}"  style="width: 60%"/>
  <h2><a href="https://adamwathan.me/advanced-vue-component-design/">Advanced Vue Component Design</a></h2>
  <p>by Adam Wathan</p>
</section>

<!-- Thank You -->
<section>
  <h2>Thank you!</h2>
  <p style="font-size: 80%;">
    <svg aria-hidden="true" width="31" height="32" focusable="false"
          style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512">
      <path fill="currentColor"
            d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
      </path>
    </svg>
    ryan at stagerightlabs dot com
  </p>
  <p style="font-size: 80%; margin-top:0">
    <svg aria-hidden="true" width="31" height="32" viewBox="0 0 496 512" focusable="false"
          style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg">
      <path fill="currentColor"
            d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 0.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-0.3 5.6 1.3 5.6 3.6zM134.8 392.9c0.7-2 3.6-3 6.2-2.3 3 0.9 4.9 3.2 4.3 5.2-0.6 2-3.6 3-6.2 2-3-0.6-5-2.9-4.3-4.9zM179 391.2c2.9-0.3 5.6 1 5.9 2.9 0.3 2-1.7 3.9-4.6 4.6-3 0.7-5.6-0.6-5.9-2.6-0.3-2.3 1.7-4.2 4.6-4.9zM244.8 8c138.7 0 251.2 105.3 251.2 244 0 110.9-67.8 205.8-167.8 239-12.7 2.3-17.3-5.6-17.3-12.1 0-8.2 0.3-49.9 0.3-83.6 0-23.5-7.8-38.5-17-46.4 55.9-6.3 114.8-14 114.8-110.5 0-27.4-9.8-41.2-25.8-58.9 2.6-6.5 11.1-33.2-2.6-67.9-20.9-6.6-69 27-69 27-20-5.6-41.5-8.5-62.8-8.5s-42.8 2.9-62.8 8.5c0 0-48.1-33.5-69-27-13.7 34.6-5.2 61.4-2.6 67.9-16 17.6-23.6 31.4-23.6 58.9 0 96.2 56.4 104.3 112.3 110.5-7.2 6.6-13.7 17.7-16 33.7-14.3 6.6-51 17.7-72.9-20.9-13.7-23.8-38.6-25.8-38.6-25.8-24.5-0.3-1.6 15.4-1.6 15.4 16.4 7.5 27.8 36.6 27.8 36.6 14.7 44.8 84.7 29.8 84.7 29.8 0 21 0.3 55.2 0.3 61.4 0 6.5-4.5 14.4-17.3 12.1-99.7-33.4-169.5-128.3-169.5-239.2 0-138.7 106.1-244 244.8-244zM97.2 352.9c1.3-1.3 3.6-0.6 5.2 1 1.7 1.9 2 4.2 0.7 5.2-1.3 1.3-3.6 0.6-5.2-1-1.7-1.9-2-4.2-0.7-5.2zM86.4 344.8c0.7-1 2.3-1.3 4.3-0.7 2 1 3 2.6 2.3 3.9-0.7 1.4-2.7 1.7-4.3 0.7-2-1-3-2.6-2.3-3.9zM118.8 380.4c1.3-1.6 4.3-1.3 6.5 1 2 1.9 2.6 4.9 1.3 6.2-1.3 1.6-4.2 1.3-6.5-1-2.3-1.9-2.9-4.9-1.3-6.2zM107.4 365.7c1.6-1.3 4.2-0.3 5.6 2 1.6 2.3 1.6 4.9 0 6.2-1.3 1-4 0-5.6-2.3-1.6-2.3-1.6-4.9 0-5.9z">
      </path>
    </svg>
    <a href="https://github.com/stagerightlabs">stagerightlabs</a>
  </p>
  <img src="../logo.png" alt="Stage Right Labs Logo" style="width: 200px" />
</section>
@endsection
