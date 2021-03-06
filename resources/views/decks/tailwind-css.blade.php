@extends('layouts.deck')

@section('title', 'Tailwind CSS')

@section('slides')
<!-- Title Page -->
<section>
  <h1>An Introduction to <br /> Tailwind CSS</h1>
</section>

<!-- About Me -->
<section>
  <img src="{{ url(asset('img/avatar.jpg')) }}" style="width: 250px" class="rounded-full" />
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
    <svg aria-hidden="true" width="31" height="32" viewBox="0 0 496 512" focusable="false" fill="currentColor"
          style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg">
      <path
            d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 0.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-0.3 5.6 1.3 5.6 3.6zM134.8 392.9c0.7-2 3.6-3 6.2-2.3 3 0.9 4.9 3.2 4.3 5.2-0.6 2-3.6 3-6.2 2-3-0.6-5-2.9-4.3-4.9zM179 391.2c2.9-0.3 5.6 1 5.9 2.9 0.3 2-1.7 3.9-4.6 4.6-3 0.7-5.6-0.6-5.9-2.6-0.3-2.3 1.7-4.2 4.6-4.9zM244.8 8c138.7 0 251.2 105.3 251.2 244 0 110.9-67.8 205.8-167.8 239-12.7 2.3-17.3-5.6-17.3-12.1 0-8.2 0.3-49.9 0.3-83.6 0-23.5-7.8-38.5-17-46.4 55.9-6.3 114.8-14 114.8-110.5 0-27.4-9.8-41.2-25.8-58.9 2.6-6.5 11.1-33.2-2.6-67.9-20.9-6.6-69 27-69 27-20-5.6-41.5-8.5-62.8-8.5s-42.8 2.9-62.8 8.5c0 0-48.1-33.5-69-27-13.7 34.6-5.2 61.4-2.6 67.9-16 17.6-23.6 31.4-23.6 58.9 0 96.2 56.4 104.3 112.3 110.5-7.2 6.6-13.7 17.7-16 33.7-14.3 6.6-51 17.7-72.9-20.9-13.7-23.8-38.6-25.8-38.6-25.8-24.5-0.3-1.6 15.4-1.6 15.4 16.4 7.5 27.8 36.6 27.8 36.6 14.7 44.8 84.7 29.8 84.7 29.8 0 21 0.3 55.2 0.3 61.4 0 6.5-4.5 14.4-17.3 12.1-99.7-33.4-169.5-128.3-169.5-239.2 0-138.7 106.1-244 244.8-244zM97.2 352.9c1.3-1.3 3.6-0.6 5.2 1 1.7 1.9 2 4.2 0.7 5.2-1.3 1.3-3.6 0.6-5.2-1-1.7-1.9-2-4.2-0.7-5.2zM86.4 344.8c0.7-1 2.3-1.3 4.3-0.7 2 1 3 2.6 2.3 3.9-0.7 1.4-2.7 1.7-4.3 0.7-2-1-3-2.6-2.3-3.9zM118.8 380.4c1.3-1.6 4.3-1.3 6.5 1 2 1.9 2.6 4.9 1.3 6.2-1.3 1.6-4.2 1.3-6.5-1-2.3-1.9-2.9-4.9-1.3-6.2zM107.4 365.7c1.6-1.3 4.2-0.3 5.6 2 1.6 2.3 1.6 4.9 0 6.2-1.3 1-4 0-5.6-2.3-1.6-2.3-1.6-4.9 0-5.9z">
      </path>
    </svg>
    <a href="https://github.com/stagerightlabs">stagerightlabs</a>
  </p>
</section>

<!-- Warning: This may sound crazy. -->
<section>
  <h1>Warning</h1>
  <p>This may sound crazy.</p>
</section>

<!-- Tweet from @devronbaldwin -->
<section>
  <img src="{{ url(asset('img/decks/devron_baldwin_tailwind_css_tweet.png')) }}" />
</section>

<!-- What is a utility framework? -->
<section>
  <h2>What is a "utility" framework?</h2>
</section>

<!-- "Grouped" style example -->
<section>
  <h3>Typical CSS Class</h3>
  <pre><code class="css" data-trim>
.profile {
display:flex;
flex-direction: column;
justify-content: space-between;
padding: 0.5rem;
margin: 1rem;
}</code></pre>
  <pre><code class="html" data-trim>
<div class="profile">
<img src="headshot.png" />
<p>This is my bio!</p>
</div></code></pre>
</section>

<!-- Utility class example -->
<section>
  <h3>Utility Classes</h3>
  <pre><code class="css" data-trim>
.flex {
display:flex;
}

.flex-column {
flex-direction: column;
}

.justify-between {
justify-content: space-between;
}

.p-2 {
padding: 0.5rem;
}

.m-4 {
margin: 1rem;
}</code></pre>
</section>

<section>
  <h3>Example Usage</h3>
  <pre><code class="html" data-trim>
<div class="flex flex-column justify-between p-2 m-4">
<img src="headshot.png" />
<p>This is my bio!</p>
</div></code></pre>
</section>

<!-- Why not use style attributes? -->
<section>
  <h2>You may be thinking:</h2>
  <p>"Why not just use style attributes?"</p>
</section>

<section>
  <h3>Style Attributes</h3>
  <pre><code class="html" data-trim>
<div style="margin: 0.5rem; padding: 1rem; /* etc... */">
<img src="headshot.png" />
<p>This is my bio!</p>
</div></code></pre>
</section>

<!-- Reason One: Design System -->
<section>
  <h2>1. Design Systems</h2>
  <p>Using a palette of pre-defined classes forces you to stick within the parameters of your design system.</p>
  <aside class="notes">
    <p>"Why are we using 23 different shades of blue on our site?"</p>
  </aside>
</section>

<!-- Reason Two: Responsive Design -->
<section>
  <h2>2. Responsive Design</h2>
  <p>Style attributes are not compatible with media queries.</p>
</section>

<section>
  <h3>Media Queries</h3>
  <pre><code class="html" data-trim>
<div class="w-full sm:w-auto md:w-1/2 lg:w-1/3 xl:w-1/4">
<!--  -->
</div></code></pre>
</section>

<!-- Reason Three: Pseudo Selectors -->
<section>
  <h2>3. Pseudo Selectors</h2>
  <p>Style attributes are not compatible with <br />pseudo selectors.</p>
</section>

<section>
  <h3>Pseudo Selectors</h3>
  <pre><code class="html" data-trim>
<div class="bg-transparent hover:bg-blue-200 focus:bg-blue-500">
<!--  -->
</div></code></pre>
</section>

<!-- Additional Benefits -->
<section>
  <h2>There are some <br /> additional benefits</h2>
</section>

<section>
  <p>1. <br />No time spent thinking of class names.</p>
</section>

<section>
  <p>2. <br />Stylesheet file size does not increase when you <br /> add more site structure.</p>
</section>

<section>
  <p>3. <br />No need to worry about breaking things when <br /> making changes down the road.</p>
</section>

<!-- What is Tailwind CSS? -->
<section>
  <img src="{{ url(asset('img/decks/tailwind_logo.svg')) }}" style="width: 250px" />
  <p>A set of pre-defined utility classes that are <br /> 100% customizable.</p>
</section>

<section>
  <h2>Default Color Palette</h2>
  <img src="{{ url(asset('img/decks/tailwind_color_example.png')) }}" />
  <p>
    <a href="https://tailwindcss.com/docs/customizing-colors/#default-color-palette">https://tailwindcss.com/docs/customizing-colors/#default-color-palette</a>
  </p>
</section>

<section>
  <h2>Default sizing scale for width, padding, margin, etc.</h2>
  <img src="{{ url(asset('img/decks/tailwind_spacing_chart.png')) }}" />
  <p>
    <a href="https://tailwindcss.com/docs/customizing-spacing#default-spacing-scale">https://tailwindcss.com/docs/customizing-spacing#default-spacing-scale</a>
  </p>
</section>

<section>
  <h2>Lots of other things...</h2>
  <ul>
    <li>CSS Reset</li>
    <li>Box Shadows</li>
    <li>Flexbox</li>
    <li>Grids &amp; Containers</li>
    <li>Media Queries</li>
    <li>Pseudo Selectors</li>
    <li>So much more...</li>
  </ul>
</section>

<!-- CDN -->
<section>
  <p>Tailwind is available through a CDN, however this will limit you to just the default styles.</p>
</section>

<section>
  <p>This is not recommended as a best practice.</p>
  <p>Instead, you should install it via NPM and <br />add it to your asset pipeline.</p>
  <p>This will allow you complete control over <br />the CSS generated by Tailwind.</p>
</section>

<!-- PostCSS -->
<section>
  <h2>PostCSS</h2>
  <p>"A tool for transforming CSS with JavaScript"</p>
  <p>(Similar to Compass for Ruby, <br />though not exactly the same...)</p>
</section>

<!-- Talk about how PostCSS works and autoprefixer -->
<section>
  <h2>How does it work?</h2>
  <blockquote>PostCSS takes a CSS file and provides an API to analyze and modify its rules (by transforming them
  into an Abstract Syntax Tree). This API can then be used by plugins to do a lot of useful things,
  e.g. to find errors or automatically insert vendor prefixes.</blockquote>
  <p><a href="https://github.com/postcss/postcss">https://github.com/postcss/postcss</a></p>
</section>

<section>
  <p>Autoprefixer</p>
  <p><a href="https://github.com/postcss/autoprefixer">https://github.com/postcss/autoprefixer</a></p>
</section>

<!-- Asset Pipeline -->
<section>
  <p>Add Tailwind to your asset pipeline:</p>
  <ul>
    <li>PostCSS Plugin</li>
    <li>Webpack</li>
    <li>Gulp</li>
    <li>Laravel Mix</li>
  </ul>
  <p><a href="https://tailwindcss.com/docs/installation#4-process-your-css-with-tailwind">https://tailwindcss.com/docs/installation#4-process-your-css-with-tailwind</a></p>
</section>

<!-- Talk about config file -->
<section>
  <h2>Tailwind Config File</h2>
  <pre><code class="js" data-trim>
// tailwind.config.js
module.exports = {
theme: {},
variants: {},
plugins: [],
}</code></pre>
</section>

<!-- No problem with the "Bootstrap Effect" -->
<section>
  <h2>Everything is Configurable</h2>
  <p>Tailwind is not susceptible to the "Bootstrap" effect.</p>
</section>

<!-- Downsides -->
<section>
  <h2>Is there a catch?</h2>
  <p>What are the downsides?</p>
</section>

<!-- Downside #1: Reusable chunks of CSS -->
<section>
  <h2>1. Duplication and Cognitive Load</h2>
  <pre><code class="html" data-trim>
<div class="px-6 py-4">
<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#photography</span>
<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#travel</span>
<span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#winter</span>
</div></code></pre>
</section>

<!-- Fix: Use @apply to extract components -->
<section>
  <h2>Solution: Components</h2>
  <pre><code class="css" data-trim>
.tag {
@apply inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700;
}</code></pre>
  <pre><code class="html" data-trim>
<div class="px-6 py-4">
<span class="tag mr-2">#photography</span>
<span class="tag mr-2">#travel</span>
<span class="tag">#winter</span>
</div></code></pre>
  <p>
    <a href="https://tailwindcss.com/docs/extracting-components">https://tailwindcss.com/docs/extracting-components</a>
  </p>
</section>

<!-- Downside #2: Stylesheet file size -->
<section>
  <h2>2. Large CSS Files</h2>
  <p>Using only the default configuration, Tailwind CSS is 477kb un-minified and uncompressed.</p>
</section>

<!-- Fix: Disable unused styles via config -->
<section>
  <h2>Solution #1</h2>
  <p>Remove unused features via the config file.</p>
</section>

<!-- Fix: PurgeCSS -->
<section>
  <h2>Solution #2</h2>
  <p>Use PurgeCSS to remove unused styles at build time.</p>
  <p>
    <a href="https://www.purgecss.com/">https://www.purgecss.com/</a>
  </p>
</section>

<section>
  <p>PurgeCSS is another PostCSS plugin that can be installed via NPM.</p>
</section>

<section>
  <p>It scans your HTML and removes <br />unused classes from your CSS file.</p>
</section>

<!-- How does PurgeCSS work? -->
<section>
  <h2>Usage:</h2>
  <ul>
    <li>Add PurgeCSS to your asset pipeline <br />(Webpack, Gulp, etc.) </li>
    <li>Tell PurgeCSS where your HTML templates live.</li>
    <li>Provide rules for allowable class names.</li>
  </ul>
  <p>Example: <a href="https://tailwindcss.com/docs/controlling-file-size/#setting-up-purgecss">https://tailwindcss.com/docs/controlling-file-size/#setting-up-purgecss</a></p>
</section>

<!-- Fix: Compression -->
<section>
  <h2>Solution #3</h2>
  <p>Use compression.</p>
  <img src="{{ url(asset('img/decks/tailwind_file_size.png')) }}" />
  <p>
    <a href="https://tailwindcss.com/docs/controlling-file-size">https://tailwindcss.com/docs/controlling-file-size</a>
  </p>
</section>

<section>
  <p>You will probably end up using a combination of tactics to manage your production builds.</p>
</section>

<!-- Demo -->
<section>
  <h2>Live Demo</h2>
</section>

<!-- Further Resources -->
<section>
  <h2>Further Resources</h2>
  <ul>
    <li><a href="https://tailwindcss.com">Documentation</a></li>
    <li><a href="https://tailwindcss.com/screencasts/">Free Screencasts</a></li>
    <li><a href="https://refactoringui.com/book/">Refactoring UI</a> Book</li>
    <li><a href="https://www.tailwindui.com/">UI Component Library</a> (Coming Soon...)</li>
    <li><a href="https://github.com/laravel-frontend-presets/tailwindcss">Laravel Frontend Preset</a></li>
  </ul>
</section>

<!-- Try it; you will like it. -->
<section>
  <img src="{{ url(asset('img/decks/tailwind_file_size.png')) }}" />
  <p>Try it. You will like it.</p>
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
</section>
@endsection
