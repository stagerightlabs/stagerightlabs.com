actions: {
  // ..
  ANIMATE({ state, dispatch }) {
    window.requestAnimationFrame(() => {
      dispatch("ANIMATE");
      state.controls.update();
    });
  }
}
