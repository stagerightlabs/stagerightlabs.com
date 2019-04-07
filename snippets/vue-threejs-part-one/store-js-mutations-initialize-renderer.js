mutations: {
  // ...
  INITIALIZE_RENDERER(state, el) {
    state.renderer = new WebGLRenderer({ antialias: true });
    state.renderer.setPixelRatio(window.devicePixelRatio);
    state.renderer.setSize(state.width, state.height);
    el.appendChild(state.renderer.domElement);
  },
}
