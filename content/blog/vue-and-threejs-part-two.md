---
title: Vue and ThreeJs - Part Two
date: '2019-04-13 14:00'
layout: BlogPost
tags:
    - Vue
    - Vuex
    - Three.js
---

Now that we have our three-dimensional sceen rendering, let's see if we can add some controls that will allow the user to manipulate what they see.

<!-- more -->

Let's start by displaying the coordinates of the camera position within the scene.   Create a new `ControlPanel.vue` component in your `src/components/` directory.

We will use a Vuex getter to retrieve the camera position and display it on the control panel:

~~~ @/snippets/vue-threejs-part-two/store-js-getters-camera-position.js{34,store.js,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/store.js#L34}

Let's import this getter into our Control Panel component:

~~~ @/snippets/vue-threejs-part-two/control-panel-initial-data.js{80,ControlPanel.vue,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/components/ControlPanel.vue#L80}

You can see that we have also added two boolean flags to the component's data object.  Later on we will use these to toggle the visibility of the pyramids and axis lines in our scene.

By mapping our vuex `CAMERA_POSITION` into the Control Panel's computed data object, we can display those coordinates and they will update in real time:

~~~ @/snippets/vue-threejs-part-two/control-panel-camera-position.html{36,ControlPanel.vue,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/components/ControlPanel.vue#L36}

(Check out the [project repo](https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/components/ControlPanel.vue) to see how this component has been styled with Tailwind utility classes.)

I have found that the trackball control implementation in Three.js can be counter-intuitive at times.  It is very easy for the user to end up somewhere they did not intend to go.  Let's add a button to our control panel that will reset the camera position to origin.  We will do that with (you guessed it) a Vuex mutation:

~~~ @/snippets/vue-threejs-part-two/store-js-mutations-reset-camera.js{143,store.js,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/store.js#L145}

Note that resetting the camera position requires more than just changing the camera position.  We also have to account for the rotation of the camera around three [additional axis](https://en.wikipedia.org/wiki/Aircraft_principal_axes#Principal_axes).  (Check out the Three.js documentation for more details.)

Now that the mutation is in place, let's add it to our Control Panel:

~~~ @/snippets/vue-threejs-part-two/control-panel-reset-camera-button.html{52,ControlPanel.vue,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/components/ControlPanel.vue#L52}

~~~ @/snippets/vue-threejs-part-two/control-panel-reset-camera.js{91,ControlPanel.vue,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/components/ControlPanel.vue#L91}

Excellent!  Everything is turning out very well so far. To wrap things up we will allow the user to manipulate what they see by selectively hiding the content of the scene.  We will have two toggles in the control panel: one to control the pyramids and one to control the axis lines.   Each will get it's own vuex mutation.

First the axis lines:

~~~ @/snippets/vue-threejs-part-two/store-js-show-hide-axis-lines.js{156,store.js,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/store.js#L158}

Next, the pyramids:

~~~ @/snippets/vue-threejs-part-two/store-js-show-hide-pyramids.js{164,store.js,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/store.js#L166}

It is important to note here that we are only able to do this because we are keeping track of the scenery in our application state, separate from the camera and the rendered scene.  If we had generated the scenery and used it to render the scene without saving it anywhere this would not be possible.

We can now import these methods into our Control Panel:

~~~ @/snippets/vue-threejs-part-two/control-panel-checkboxes.html{15,ControlPanel.vue,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/components/ControlPanel.vue#L15}

~~~ @/snippets/vue-threejs-part-two/control-panel-toggle-scenery.js{91,ControlPanel.vue,https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/components/ControlPanel.vue#L91}

We have now finished our

You have now successfully used Vue, Vuex and Three.js to create and manage a three-dimensional scene in your browser. [You can see this code in action here](https://vuethree.stagerightlabs.com/). This demonstration is somewhat simplistic, but the ideas here should provide a solid foundation for building a more realistic application.
