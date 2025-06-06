function updateHowItWasPanel(swiperInstance) {
  const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
  if (!activeSlide) return;

  document.getElementById('hiw-title').textContent = activeSlide.dataset.title || '—';
  document.getElementById('hiw-description').textContent = activeSlide.dataset.description || '—';
}

const hiwSwiper = new Swiper('.rfc-how-it-was .rfc-hiw__slider', {
  slidesPerView: 4,
  spaceBetween: 20,
  loop: true,
  centeredSlides: false,
  initialSlide: 0,
  navigation: {
    nextEl: '.rfc-hiw__button--next',
    prevEl: '.rfc-hiw__button--prev',
  },
  thumbs: {
    swiper: {
      el: '.rfc-hiw__thumbs',
      slidesPerView: 6,
      spaceBetween: 20,
      watchSlidesProgress: true,
    }
  },
  breakpoints: {
    0: {
      slidesPerView: 'auto',
      spaceBetween: 20,
      effect: 'coverflow',
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        scale: 0.75,
        depth: 100,
        slideShadows: false,
      },
    },
    1180: {
      slidesPerView: 4,
      spaceBetween: 20,
      effect: 'slide'
    }
  },
  on: {
    init(swiper) {
      updateHowItWasPanel(swiper);
    },
    slideChange(swiper) {
      updateHowItWasPanel(swiper);
    },
  }
});


