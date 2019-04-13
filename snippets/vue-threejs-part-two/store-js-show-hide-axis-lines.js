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
