// ===========================
// An Express Courier - Main JS
// ===========================

// Navbar scroll effect
const mainNav = document.getElementById('mainNav');
function handleNavScroll(){
  if(window.scrollY > 30){
    mainNav.classList.add('scrolled');
  }else{
    mainNav.classList.remove('scrolled');
  }
}
window.addEventListener('scroll', handleNavScroll);
handleNavScroll();

// Close mobile navbar on link click
document.querySelectorAll('#navMenu .nav-link').forEach(link => {
  link.addEventListener('click', () => {
    const navMenu = document.getElementById('navMenu');
    if(navMenu.classList.contains('show')){
      bootstrap.Collapse.getOrCreateInstance(navMenu).hide();
    }
  });
});

// Active link highlight on scroll
const sections = document.querySelectorAll('section[id], header[id]');
const navLinks = document.querySelectorAll('#navMenu .nav-link');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(section => {
    const sectionTop = section.offsetTop - 120;
    if(window.scrollY >= sectionTop){
      current = section.getAttribute('id');
    }
  });
  navLinks.forEach(link => {
    link.classList.remove('active');
    if(link.getAttribute('href') === `#${current}`){
      link.classList.add('active');
    }
  });
});

// Animated counters (triggered when visible)
const counters = document.querySelectorAll('.counter');
const speed = 60;

function animateCounter(counter){
  const target = +counter.getAttribute('data-target');
  const increment = Math.max(target / speed, 1);
  let current = 0;

  const update = () => {
    current += increment;
    if(current < target){
      counter.innerText = Math.ceil(current).toLocaleString();
      requestAnimationFrame(update);
    }else{
      counter.innerText = target.toLocaleString();
    }
  };
  update();
}

const counterObserver = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if(entry.isIntersecting){
      animateCounter(entry.target);
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.5 });

counters.forEach(counter => counterObserver.observe(counter));

// Back to top button
const backToTop = document.querySelector('.back-to-top');
window.addEventListener('scroll', () => {
  if(window.scrollY > 400){
    backToTop.classList.add('show');
  }else{
    backToTop.classList.remove('show');
  }
});

// Footer year
const yearEl = document.getElementById('year');
if(yearEl){ yearEl.textContent = new Date().getFullYear(); }

// Simple tracking form demo feedback
const trackForm = document.querySelector('.tracking-box form');
if(trackForm){
  trackForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const input = trackForm.querySelector('input');
    if(input.value.trim() === ''){
      input.focus();
      return;
    }
    alert(`Tracking parcel: ${input.value.trim()}\n(Demo only — connect this to your backend API.)`);
  });
}

// Newsletter form demo feedback
const newsletterForm = document.querySelector('.newsletter-form');
if(newsletterForm){
  newsletterForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const input = newsletterForm.querySelector('input');
    if(input.value.trim() !== ''){
      alert('Thanks for subscribing!');
      input.value = '';
    }
  });
}
