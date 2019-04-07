mutations: {
  // ...
  INITIALIZE_CAMERA(state) {
    state.camera = new PerspectiveCamera(
      // 1. Field of View (degrees)
      60,
      // 2. Aspect ratio
      state.width / state.height,
      // 3. Near clipping plane
      1,
      // 4. Far clipping plane
      1000
    );
    state.camera.position.z = 500;
  },
}
