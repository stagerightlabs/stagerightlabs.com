mutations: {
  // ...
  INITIALIZE_CONTROLS(state) {
    state.controls = new TrackballControls(
      state.camera,
      state.renderer.domElement
    );
    state.controls.rotateSpeed = 1.0;
    state.controls.zoomSpeed = 1.2;
    state.controls.panSpeed = 0.8;
    state.controls.noZoom = false;
    state.controls.noPan = false;
    state.controls.staticMoving = true;
    state.controls.dynamicDampingFactor = 0.3;
  },
}
