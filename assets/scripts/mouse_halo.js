document.addEventListener('DOMContentLoaded', () => {

  var halo = document.getElementById('halo');
  var doc = document.querySelector('.experience');

  const lateralNav = document.querySelector('.lateral_nav'); 

  doc.addEventListener('mousemove', (e)=> {

    halo.style.left = `${e.pageX - 25}px`; 
    halo.style.top = `${e.pageY - 25}px`; 

  });
})

