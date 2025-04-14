
const header = document.querySelector('header');


window.addEventListener('scroll', () => {

  if (window.scrollY > 0) {

    header.style.backgroundColor = '#07071b';
  } else {

    header.style.backgroundColor = 'transparent';
  }
});


function showContent(btn) {
  const dots = btn.previousElementSibling.querySelector('#dots');
  const moreText = btn.previousElementSibling.querySelector('#moreContent');

  if (dots.style.display === 'none') {
    dots.style.display = 'inline';
    btn.innerHTML = 'Leer más';
    moreText.style.display = 'none';
  } else {
    dots.style.display = 'none';
    btn.innerHTML = 'Leer menos';
    moreText.style.display = 'inline';
  }
}

// document.addEventListener('DOMContentLoaded', () => {

//   showWindow()

// })
// //cookies popup
// function closeWindow() {
//   document.getElementById("overlay").style.display = "none";
//   document.getElementById("popup").style.display = "none";
// }

// function showWindow() {
//   document.getElementById("overlay").style.display = "block";
//   document.getElementById("popup").style.display = "block";
// }
