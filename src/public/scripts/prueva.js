
// Slider functionality
const slider = document.getElementById('welcome-slider');
const dots = document.querySelectorAll('.pagination .dot');
const prevBtn = document.querySelector('.prev-slide');
const nextBtn = document.querySelector('.next-slide');
const totalSlides = dots.length;
let currentSlide = 0;

// Function to update slider position
function goToSlide(slideIndex) {
  if (slideIndex < 0) {
    slideIndex = totalSlides - 1;
  } else if (slideIndex >= totalSlides) {
    slideIndex = 0;
  }
  
  currentSlide = slideIndex;
  slider.style.transform = `translateX(-${currentSlide * 100}%)`;
  
  // Update active dot
  dots.forEach((dot, index) => {
    dot.classList.toggle('active', index === currentSlide);
  });
}

// Event listeners for dots
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    goToSlide(index);
  });
});

// Event listeners for arrows
prevBtn.addEventListener('click', () => {
  goToSlide(currentSlide - 1);
});

nextBtn.addEventListener('click', () => {
  goToSlide(currentSlide + 1);
});

// Auto-advance slider every 5 seconds
let sliderInterval = setInterval(() => {
  goToSlide(currentSlide + 1);
}, 5000);

// Pause auto-advance on hover
slider.parentElement.addEventListener('mouseenter', () => {
  clearInterval(sliderInterval);
});

slider.parentElement.addEventListener('mouseleave', () => {
  sliderInterval = setInterval(() => {
    goToSlide(currentSlide + 1);
  }, 5000);
});

// Toggle sidebar functionality
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('main-content');
const toggleBtn = document.getElementById('toggle-sidebar');
const toggleIcon = document.getElementById('toggle-icon');

toggleBtn.addEventListener('click', () => {
  sidebar.classList.toggle('sidebar-collapsed');
  mainContent.classList.toggle('main-content-expanded');
  toggleBtn.classList.toggle('collapsed');
  
  if (toggleIcon.classList.contains('fa-chevron-left')) {
    toggleIcon.classList.remove('fa-chevron-left');
    toggleIcon.classList.add('fa-chevron-right');
    spanMenu.style.display='none';


  } else {
    toggleIcon.classList.remove('fa-chevron-right');
    toggleIcon.classList.add('fa-chevron-left');
    spanMenu.style.display='flex';

  }
});

// Menu item active state
const menuItems = document.querySelectorAll('.menu-item');
menuItems.forEach(item => {
  item.addEventListener('click', () => {
    menuItems.forEach(i => i.classList.remove('active'));
    item.classList.add('active');
  });
});

// Mobile menu functionality
if (window.innerWidth <= 768) {
  sidebar.classList.add('sidebar-collapsed');
  mainContent.classList.add('main-content-expanded');
  toggleBtn.classList.add('collapsed');
  toggleIcon.classList.remove('fa-chevron-left');
  toggleIcon.classList.add('fa-chevron-right');
}

// Responsive adjustments
window.addEventListener('resize', () => {
  if (window.innerWidth <= 768) {
    sidebar.classList.add('sidebar-collapsed');
    mainContent.classList.add('main-content-expanded');
    toggleBtn.classList.add('collapsed');
    toggleIcon.classList.remove('fa-chevron-left');
    toggleIcon.classList.add('fa-chevron-right');
  }
});

