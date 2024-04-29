function adjustNavForScreenSize() {
  const navElement = document.querySelector('nav');
  
  if (window.innerWidth < 768) {
    navElement.classList.add('is-hidden');
    console.log('small size');
  } else {
    navElement.classList.remove('is-hidden');
    console.log('size move');
  }
}

// Ajuster le nav au chargement initial
adjustNavForScreenSize();

// Ajuster le nav lorsque la taille de la fenêtre change
window.addEventListener('resize', adjustNavForScreenSize);

document.addEventListener('DOMContentLoaded', () => {
  const hamburger = document.querySelector('.hamburger');
  const nav = document.getElementById('navigation');

  hamburger.addEventListener('click', () => {
    nav.classList.toggle('is-hidden');
  });
});

function checkWindowSize() {
  const nav = document.getElementById('navigation');
  if (window.innerWidth > 768) {
    // S'assurer que le menu est affiché en mode desktop
    nav.classList.remove('is-hidden');
  }
}

// Vérifier la taille de la fenêtre lors du chargement de la page
checkWindowSize();

// Vérifier la taille de la fenêtre à chaque redimensionnement
window.addEventListener('resize', checkWindowSize);

