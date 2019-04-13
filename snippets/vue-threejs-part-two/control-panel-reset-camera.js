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
