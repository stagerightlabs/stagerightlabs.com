---
title: 'Using Tailwind with SASS, Vue-CLI and Wepback'
published: true
date: '2017-12-18 16:18'
layout: BlogPost
categories:
  - Vue
  - Tailwind
  - Webpack
---

I recently decided to revamp my personal home page as a Vue SPA. I am not much of a designer, so I am going to use a free design from [HTML5 Up!](https://html5up.net/) as a starting point and riff from there. Most of those templates make heavy use of Sass - of which I am a big fan. Theoretically you can use PostCSS plugins to replicate everything that SASS does, but I am not ready to make that leap yet. Perhaps someday. So, my plan is to use the Vue CLI webpack starter template along with an HTML5 Up design as the foundation for my new site.

<!-- more -->

Just to mix things up, I thought I would also try taking [Tailwind CSS](https://tailwindcss.com/) for a spin as well. I may have to re-work quite a bit of the design template to integrate it with the Tailwind framework, but if it works it will be worth the effort.

Here are the steps I took to get my dev setup up and running:

Start by [installing](https://github.com/vuejs/vue-cli) the Vue CLI tool and then using it to generate a new site:

```bash
$ vue init webpack homepage
```

I used all the default answers to the prompts, and I had Vue CLI run `npm install` for me. Next, after moving my terminal session into the new project directory, I installed Sass and Tailwind CSS:

```bash
$ npm install node-sass sass-loader tailwindcss --save-dev
```

and then I initialized my new `tailwind.js` configuration file:

```bash
$ ./node_modules/.bin/tailwind init tailwind.js
```

We also need to update the `.postcssrc.js` file to have Post CSS trigger the tailwind compliation step:

```js
module.exports = {
  plugins: [require("tailwindcss")("tailwind.js"), require("autoprefixer")()]
};
```

Now everything has been installed, we just need to get it all working together. Start by creating an `app.scss` file in a new `/src/assets/scss/` directory, and then pasting in the tailwind base directives. In the example below I have removed the comments to save space.

```sass
// src/assets/scss/app.scss

@tailwind preflight;

/* Custom Sass goes here... */

@tailwind utilities;
```

Next, locate the "style" section in the `App.vue` file and replace it with this:

```html
<style lang="sass">
    @import "./assets/scss/app.scss"
</style>
```

Note that when using Sass with the Vue Style loader (which allows for using Sass in Vue Component files) you have to be specific here about which type of sass files you will be using. If you specify `lang="scss"` the loader will assume you are using the "indentation" style of sass files, whereas `lang="sass"` will indicate the use of bracket style sass files.

At this point, you should be able to run `npm run dev` to compile the assets and launch a dev server.

To verify that everything is working, try updating your app.scss file to look like this:

```sass
// src/assets/scss/app.scss

@tailwind preflight;

#app {
  @apply .text-center .text-grey-darker .mt-8;
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

@tailwind utilities;
```

If everything is working correctly, wepback will automatically recompile that file and refresh the dev server content, and you should see that we are now successfully using Tailwind CSS directives to manipulate the content on the home page.
