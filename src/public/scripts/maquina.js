import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';

// Model container settings 
const container = document.getElementById('3d-model');
const containerWidth = 600;
const containerHeight = 400;

// Renderer settings
const renderer = new THREE.WebGLRenderer();
renderer.setSize(containerWidth, containerHeight);
container.appendChild(renderer.domElement);

// Camera settings
const camera = new THREE.PerspectiveCamera(45, containerWidth / containerHeight, 1, 1000);
const scene = new THREE.Scene();
scene.add(new THREE.AxesHelper(1));

const controls = new OrbitControls(camera, renderer.domElement);

const ambientLight = new THREE.AmbientLight(0xFFFFFF, 0.5);
scene.add(ambientLight);

scene.background = new THREE.Color(0xFFFFFFF);

let PrototipeModel;

const loader = new GLTFLoader();

loader.load('../Model/maquina.glb', (gltf) => {
    PrototipeModel = gltf.scene;

    // Adjust the position and initial rotation of the model object
    PrototipeModel.position.set(20, -10, 0);
    PrototipeModel.rotation.set(-6, -7, 0);

    // Adjust the position of the camera to center the 3d model
    const boundingBox = new THREE.Box3().setFromObject(PrototipeModel);
    const modelCenter = new THREE.Vector3();
    boundingBox.getCenter(modelCenter);

    // Adjust the distance between the camera and the 3d model
    const cameraDistance = boundingBox.max.z * 3.5;
    camera.position.set(modelCenter.x, modelCenter.y, modelCenter.z + cameraDistance);

    // Make the camera look to the center of the 3d model
    camera.lookAt(modelCenter);

    scene.add(PrototipeModel);
});

function animate() {
    requestAnimationFrame(animate);

    controls.update();

    renderer.render(scene, camera);

    PrototipeModel.rotate += -0.01;
}

animate();

//reset the model position functionnality
const reset_btn = document.getElementById('resetModelPosition');

reset_btn.addEventListener('click', () => {
    resetPosition()
});

function resetPosition() {

}


