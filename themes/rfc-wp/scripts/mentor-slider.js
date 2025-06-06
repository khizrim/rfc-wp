const mentorsSwiper = new Swiper('.mentors__swiper', {
  loop: true,
  centeredSlides: true,
  spaceBetween: 90,
  effect: 'coverflow',
  parallax: true,
  autoHeight: true,
  scrollable: true,
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    scale: 0.9,
    depth: 100,
    slideShadows: false,
  },
  navigation: {
    nextEl: '.mentors__button--next',
    prevEl: '.mentors__button--prev',
  },
  breakpoints: {
    0: {
      slidesPerView: 'auto',
      spaceBetween: 20
    },
    768: {
      slidesPerView: 'auto',
      spaceBetween: 140,
    }
  }
});
