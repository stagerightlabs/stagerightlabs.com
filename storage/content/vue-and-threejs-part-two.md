---
title: Vue and ThreeJs - Part Two
date: 2019-04-13
summary: Let's continue our experiment with Three.js and Vue.js. We will look at setting up a control panel that lets users manually adjust the content of our three dimensional scene.
tags:
    - Three.js
    - Vue
    - Vuex
series: Vue and ThreeJs
episode: 2
---

Now that we have our three-dimensional screen rendering, let's see if we can add some controls that will allow the user to manipulate what they see.

Let's start by displaying the coordinates of the camera position within the scene.   Create a new `ControlPanel.vue` component in your `src/components/` directory.

We will use a Vuex getter to retrieve the camera position and display it on the control panel:

```js
getters: {
  CAMERA_POSITION: state => {
    return state.camera ? state.camera.position : null;
  }
},
```

Let's import this getter into our Control Panel component:

```js
import { mapGetters, mapMutations } from "vuex";
export default {
  data () {
    return {
      axisLinesVisible: true,
      pyramidsVisible: true
    };
  },
  computed: {
    ...mapGetters(["CAMERA_POSITION"])
  },
  // ...
}
```

You can see that we have also added two boolean flags to the component's data object.  Later on we will use these to toggle the visibility of the pyramids and axis lines in our scene.

By mapping our vuex `CAMERA_POSITION` into the Control Panel's computed data object, we can display those coordinates and they will update in real time:

```html
<div
  v-if="CAMERA_POSITION"
  class="border-b border-grey-darkest mb-2 pb-2"
>
  <p class="mb-1 text-grey-light font-bold">
    Camera Position
  </p>
  <p class="flex justify-between w-full mb-2 text-grey-light">
    X:<span class="text-white">{{ CAMERA_POSITION.x }}</span>
  </p>
  <p class="flex justify-between w-full mb-2 text-grey-light">
    Y:<span class="text-white">{{ CAMERA_POSITION.y }}</span>
  </p>
  <p class="flex justify-between w-full mb-2 text-grey-light">
    Z:<span class="text-white">{{ CAMERA_POSITION.z }}</span>
  </p>
  <!-- more... -->
</div>
```

(Check out the [project repo](https://github.com/stagerightlabs/Vue-Three-Demo/blob/master/src/components/ControlPanel.vue) to see how this component has been styled with Tailwind utility classes.)

I have found that the trackball control implementation in Three.js can be counter-intuitive at times.  It is very easy for the user to end up somewhere they did not intend to go.  Let's add a button to our control panel that will reset the camera position to origin.  We will do that with (you guessed it) a Vuex mutation:

```js
mutations: {
  // ...
  SET_CAMERA_POSITION(state, { x, y, z }) {
    if (state.camera) {
      state.camera.position.set(x, y, z);
    }
  },
  RESET_CAMERA_ROTATION(state) {
    if (state.camera) {
      state.camera.rotation.set(0, 0, 0);
      state.camera.quaternion.set(0, 0, 0, 1);
      state.camera.up.set(0, 1, 0);
      state.controls.target.set(0, 0, 0);
    }
  },
  // ...
}
```

Note that resetting the camera position requires more than just changing the camera position.  We also have to account for the rotation of the camera around three [additional axis](https://en.wikipedia.org/wiki/Aircraft_principal_axes#Principal_axes).  (Check out the Three.js documentation for more details.)

Now that the mutation is in place, let's add it to our Control Panel:

```html
<p class="flex items-center">
  <button
    class="bg-grey-light cursor-pointer shadow p-2 mx-auto"
    @click="resetCameraPosition"
  >
    Reset Camera
  </button>
</p>
```

```js
methods: {
  ...mapMutations([
    "SET_CAMERA_POSITION",
    "RESET_CAMERA_ROTATION",
  ]),
  resetCameraPosition() {
    this.SET_CAMERA_POSITION({ x: 0, y: 0, z: 500 });
    this.RESET_CAMERA_ROTATION();
  },
  // ...
}
```

Excellent!  Everything is turning out very well so far. To wrap things up we will allow the user to manipulate what they see by selectively hiding the content of the scene.  We will have two toggles in the control panel: one to control the pyramids and one to control the axis lines.   Each will get it's own vuex mutation.

First the axis lines:

```js
mutations: {
  // ..
  HIDE_AXIS_LINES(state) {
    state.scene.remove(...state.axisLines);
    state.renderer.render(state.scene, state.camera);
  },
  SHOW_AXIS_LINES(state) {
    state.scene.add(...state.axisLines);
    state.renderer.render(state.scene, state.camera);
  },
  // ..
}
```

Next, the pyramids:

```js
mutations: {
  // ...
  HIDE_PYRAMIDS(state) {
    state.scene.remove(...state.pyramids);
    state.renderer.render(state.scene, state.camera);
  },
  SHOW_PYRAMIDS(state) {
    state.scene.add(...state.pyramids);
    state.renderer.render(state.scene, state.camera);
  }
}
```

It is important to note here that we are only able to do this because we are keeping track of the scenery in our application state, separate from the camera and the rendered scene.  If we had generated the scenery and used it to render the scene without saving it anywhere this would not be possible.

We can now import these methods into our Control Panel:

```html
<p class="flex items-center justify-between mb-1">
  Pyramids
  <input
    type="checkbox"
    name="pyramids"
    id="pyramids"
    v-model="pyramidsVisible"
    @click="togglePyramids"
  />
</p>
<p class="flex items-center justify-between">
  Axis Lines
  <input
    type="checkbox"
    name="axis-lines"
    id="axis-lines"
    v-model="axisLinesVisible"
    @click="toggleAxisLines"
  />
</p>
```

```js
methods: {
  ...mapMutations([
    "SET_CAMERA_POSITION",
    "RESET_CAMERA_ROTATION",
    "HIDE_AXIS_LINES",
    "SHOW_AXIS_LINES",
    "HIDE_PYRAMIDS",
    "SHOW_PYRAMIDS"
  ]),
  resetCameraPosition() {
    this.SET_CAMERA_POSITION({ x: 0, y: 0, z: 500 });
    this.RESET_CAMERA_ROTATION();
  },
  toggleAxisLines() {
    if (this.axisLinesVisible) {
      this.HIDE_AXIS_LINES();
      this.axisLinesVisible = false;
    } else {
      this.SHOW_AXIS_LINES();
      this.axisLinesVisible = true;
    }
  },
  togglePyramids() {
    if (this.pyramidsVisible) {
      this.HIDE_PYRAMIDS();
      this.pyramidsVisible = false;
    } else {
      this.SHOW_PYRAMIDS();
      this.pyramidsVisible = true;
    }
  }
}
```

You have now successfully used Vue, Vuex and Three.js to create and manage a three-dimensional scene in your browser. [You can see this code in action here](https://vuethree.stagerightlabs.com/). This demonstration is somewhat simplistic, but the ideas here should provide a solid foundation for building a more realistic application.
