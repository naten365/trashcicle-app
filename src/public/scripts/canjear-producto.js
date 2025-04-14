//store the user points into a vatiable from the localStorage
let userPoints = parseInt(localStorage.getItem('userPoints'));
let pointsValue = document.querySelector('#userPointsValue');

//store the product title  and the
const exchangeProductBTN = document.querySelector('.product-exchange-btn');
let productTitle = document.querySelector('h1').textContent;
let productPointsAmount = parseInt(document.querySelector('#amountOfPoints').textContent, 10);

document.title = `Canjear ${productTitle} | TrashCicle`;

exchangeProductBTN.addEventListener('click', function() {
    userConfirmation = confirm('¿Quieres canjear este producto?');

    if (userConfirmation === true) {
        exchangeProduct(productTitle, productPointsAmount);
        return true;
    } else {
        return false;
    }
});

function exchangeProduct(productName, pointsAmount) {
    if (userPoints >= pointsAmount) {
        userPoints -= pointsAmount;
        localStorage.setItem('userPoints', userPoints);
        pointsValue.textContent = userPoints;  // Actualiza el contenido del elemento DOM
        
        alert(`¡Has canjeado ${productName} exitosamente! ¡Revise su correo electrónico para recibir su producto!`);
    } else {
        alert('No tienes puntos suficientes para canjear este producto.');
    }
}
