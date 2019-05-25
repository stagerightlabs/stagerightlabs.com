# stagerightlabs.com

## Powered by [VuePress](https://vuepress.vuejs.org/)

To run locally, clone the repository and then:

```sh
# Install the dependencies
npm install

# Run the local development server:
npm run dev
```

To build for deployment:

```
npm run build
```

Once built, the contents of the `.vuepress/dist` folder can then be deployed.

## Theme

This site uses a custom theme that was built in-house using [Tailwind CSS](https://tailwindcss.com/).  The background image was designed by [Atle Mo](http://atlemo.dribbble.com/) (via [subtlepatterns.com](subtlepatterns.com)). The icons come from [Font Awesome](fontawesome.com).

## Plugins

This site makes use of a handful of third party plugins; the exact list can be seen in the [`config.js`](https://github.com/stagerightlabs/stagerightlabs.com/blob/dev/content/.vuepress/config.js#L31) file.

If you are curious, the method used for displaying code snippets is not something that comes with VuePress out of the box.  I created a [custom plugin](https://github.com/stagerightlabs/stagerightlabs.com/blob/dev/content/.vuepress/theme/plugins/snippets.js) that reads the snippet content from a separate file and embeds it in the target file as a table, similar to the method used with github gists.  The plugin allows the line numbers and snippet label to be customized as needed, and will optionally link the snippet label to a custom URL if desired.
