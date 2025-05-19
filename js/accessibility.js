
/* Gør det muligt at tilføje aria-labels til knapperne i Elementor Billedkarussel */
document.addEventListener('DOMContentLoaded', function () {
  const prevButtons = document.querySelectorAll('.elementor-swiper-button-prev');
  const nextButtons = document.querySelectorAll('.elementor-swiper-button-next');

  prevButtons.forEach(function (btn) {
    btn.setAttribute('aria-label', 'Forrige billede');
  });

  nextButtons.forEach(function (btn) {
    btn.setAttribute('aria-label', 'Næste billede');
  });
});