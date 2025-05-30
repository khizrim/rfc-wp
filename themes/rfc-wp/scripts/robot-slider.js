function updateRobotPanel(swiperInstance) {
  const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
  document.getElementById('robot-name').textContent = activeSlide.dataset.title;
  document.getElementById('robot-team').textContent = activeSlide.dataset.team;
  document.getElementById('robot-attack').textContent = activeSlide.dataset.attack;
  document.getElementById('robot-defense').textContent = activeSlide.dataset.defense;
}

const swiper = new Swiper('.rfc-robots__slider', {
  loop: true,
  centeredSlides: true,
  slidesPerView: 1,
  navigation: {
    nextEl: '.rfc-robots__nav--next',
    prevEl: '.rfc-robots__nav--prev',
  },
  effect: 'coverflow',
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    scale: 0.5,
    depth: 100,
    slideShadows: false,
  },
  width: 600,
  on: {
    init(swiper) {
      updateRobotPanel(swiper);
    },
    slideChange(swiper) {
      updateRobotPanel(swiper);
    },
  },
});
