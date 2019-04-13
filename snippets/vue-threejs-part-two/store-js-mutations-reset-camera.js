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
