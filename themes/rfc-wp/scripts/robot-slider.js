function updateRobotPanel(swiperInstance) {
  const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
  document.getElementById('robot-name').textContent = activeSlide.dataset.title;
  document.getElementById('robot-team').textContent = activeSlide.dataset.team;
  document.getElementById('robot-attack').textContent = activeSlide.dataset.attack;
  document.getElementById('robot-defense').textContent = activeSlide.dataset.defense;
}

const robotSwiper = new Swiper('.rfc-robots__slider', {
  loop: true,
  slidesPerView: 'auto',
  centeredSlides: true,
  navigation: {
    nextEl: '.rfc-robots__button--next',
    prevEl: '.rfc-robots__button--prev',
  },
  effect: 'coverflow',
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    scale: 0.75,
    depth: 100,
    slideShadows: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 'auto',
      spaceBetween: 20
    },
    768: {
      slidesPerView: 'auto',
      spaceBetween: 160,
    }
  },
  on: {
    init(swiper) {
      updateRobotPanel(swiper);
    },
    slideChange(swiper) {
      updateRobotPanel(swiper);
    },
  },
});
