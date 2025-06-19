document.addEventListener("DOMContentLoaded", function () {
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

  function updateHowItWasPanel(swiperInstance) {
    const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
    if (!activeSlide) return;

    document.getElementById("hiw-title").textContent =
      activeSlide.dataset.title || "—";
    document.getElementById("hiw-description").textContent =
      activeSlide.dataset.description || "—";
  }

  const sliderContainer = document.querySelector(
    ".rfc-how-it-was .rfc-hiw__slider"
  );
  if (!sliderContainer) return;

  const hiwSwiper = new Swiper(".rfc-how-it-was .rfc-hiw__slider", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    loop: true,
    initialSlide: 0,
    lazy: {
      loadPrevNext: true,
      loadPrevNextAmount: 2,
    },
    coverflowEffect: {
      rotate: 0,
      modifier: 1,
      stretch: -40,
      slideShadows: true,
    },
    breakpoints: {
      0: {
        coverflowEffect: {
          rotate: 0,
          modifier: 1,
        },
      },
      768: {
        coverflowEffect: {
          rotate: 0,
          modifier: 1,
        },
      },
      1180: {
        coverflowEffect: {
          rotate: 0,
          modifier: 1,
        },
      },
    },
    on: {
      init(swiper) {
        updateHowItWasPanel(swiper);
      },
      slideChange: debounce(function (swiper) {
        updateHowItWasPanel(swiper);
      }, 100),
    },
  });
});
