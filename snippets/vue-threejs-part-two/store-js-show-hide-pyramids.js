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
