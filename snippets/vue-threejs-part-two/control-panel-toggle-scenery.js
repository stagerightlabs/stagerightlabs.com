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
