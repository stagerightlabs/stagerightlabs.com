actions: {
  INIT({ state, commit }, { width, height, el }) {
    return new Promise(resolve => {
      commit("SET_VIEWPORT_SIZE", { width, height });
      commit("INITIALIZE_RENDERER", el);
      commit("INITIALIZE_CAMERA");
      commit("INITIALIZE_CONTROLS");
      commit("INITIALIZE_SCENE");

      // Initial scene rendering
      state.renderer.render(state.scene, state.camera);

      // Add an event listener that will re-render
      // the scene when the controls are changed
      state.controls.addEventListener("change", () => {
        state.renderer.render(state.scene, state.camera);
      });

      resolve();
    });
  },
}
