mutations: {
  // ...
  INITIALIZE_SCENE(state) {
    state.scene = new Scene();
    state.scene.background = new Color(0xcccccc);
    state.scene.fog = new FogExp2(0xcccccc, 0.002);
    var geometry = new CylinderBufferGeometry(0, 10, 30, 4, 1);
    var material = new MeshPhongMaterial({
      color: 0xffffff,
      flatShading: true
    });
    for (var i = 0; i < 500; i++) {
      var mesh = new Mesh(geometry, material);
      mesh.position.x = (Math.random() - 0.5) * 1000;
      mesh.position.y = (Math.random() - 0.5) * 1000;
      mesh.position.z = (Math.random() - 0.5) * 1000;
      mesh.updateMatrix();
      mesh.matrixAutoUpdate = false;
      state.pyramids.push(mesh);
    }
    state.scene.add(...state.pyramids);

    // lights
    var lightA = new DirectionalLight(0xffffff);
    lightA.position.set(1, 1, 1);
    state.scene.add(lightA);
    var lightB = new DirectionalLight(0x002288);
    lightB.position.set(-1, -1, -1);
    state.scene.add(lightB);
    var lightC = new AmbientLight(0x222222);
    state.scene.add(lightC);

    // Axis Line 1
    var materialB = new LineBasicMaterial({ color: 0x0000ff });
    var geometryB = new Geometry();
    geometryB.vertices.push(new Vector3(0, 0, 0));
    geometryB.vertices.push(new Vector3(0, 1000, 0));
    var lineA = new Line(geometryB, materialB);
    state.axisLines.push(lineA);

    // Axis Line 2
    var materialC = new LineBasicMaterial({ color: 0x00ff00 });
    var geometryC = new Geometry();
    geometryC.vertices.push(new Vector3(0, 0, 0));
    geometryC.vertices.push(new Vector3(1000, 0, 0));
    var lineB = new Line(geometryC, materialC);
    state.axisLines.push(lineB);

    // Axis 3
    var materialD = new LineBasicMaterial({ color: 0xff0000 });
    var geometryD = new Geometry();
    geometryD.vertices.push(new Vector3(0, 0, 0));
    geometryD.vertices.push(new Vector3(0, 0, 1000));
    var lineC = new Line(geometryD, materialD);
    state.axisLines.push(lineC);

    state.scene.add(...state.axisLines);
  },
}
