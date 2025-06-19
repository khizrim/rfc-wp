document.addEventListener("DOMContentLoaded", function () {
  // Debounce function to limit how often a function can be called
  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  function updateRobotPanel(swiperInstance) {
    const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
    if (!activeSlide) return;

    document.getElementById("robot-name").textContent =
      activeSlide.dataset.title;
    document.getElementById("robot-team").textContent =
      activeSlide.dataset.team;
    document.getElementById("robot-attack").textContent =
      activeSlide.dataset.attack;
    document.getElementById("robot-defense").textContent =
      activeSlide.dataset.defense;
  }

  // Initialize slider only if the container exists
  const sliderContainer = document.querySelector(".rfc-robots__slider");
  if (!sliderContainer) return;

  const robotSwiper = new Swiper(".rfc-robots__slider", {
    loop: true,
    slidesPerView: "auto",
    centeredSlides: true,
    watchSlidesProgress: true,
    preloadImages: false,
    lazy: {
      loadPrevNext: true,
      loadPrevNextAmount: 2,
    },
    navigation: {
      nextEl: ".rfc-robots__button--next",
      prevEl: ".rfc-robots__button--prev",
    },
    effect: "coverflow",
    coverflowEffect: {
      rotate: 0,
      stretch: 0,
      scale: 0.5,
      depth: 100,
      slideShadows: false,
    },
    breakpoints: {
      0: {
        slidesPerView: "auto",
        spaceBetween: 20,
      },
      768: {
        slidesPerView: "auto",
        spaceBetween: 0,
      },
    },
    on: {
      init(swiper) {
        updateRobotPanel(swiper);
      },
      slideChange: debounce(function (swiper) {
        updateRobotPanel(swiper);
      }, 100),
    },
  });
});
