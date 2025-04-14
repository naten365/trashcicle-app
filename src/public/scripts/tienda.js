document.addEventListener('DOMContentLoaded', () => {

    // let userPoints = 10000;
    // localStorage.setItem('userPoints', userPoints);
    let pointsValue = document.querySelector('#userPointsValue');

    let retrievedPoints = localStorage.getItem('userPoints');
    pointsValue.textContent = retrievedPoints;

});