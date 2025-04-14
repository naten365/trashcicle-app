
const header = document.querySelector('header');


window.addEventListener('scroll', () => {

  if (window.scrollY > 0) {
   
    header.style.backgroundColor = '#07071b';
  } else {

    header.style.backgroundColor = 'transparent';
  }
}); 
