mutations: {
  // ...
  RESIZE(state, { width, height }) {
    state.width = width;
    state.height = height;
    state.camera.aspect = width / height;
    state.camera.updateProjectionMatrix();
    state.renderer.setSize(width, height);
    state.controls.handleResize();
    state.renderer.render(state.scene, state.camera);
  },
}
