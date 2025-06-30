document.addEventListener("DOMContentLoaded", function () {
  // Initialize slider only if the container exists
  const sliderContainer = document.querySelector(".rfc-mentors__swiper");
  if (!sliderContainer) return;

  const mentorsSwiper = new Swiper(".rfc-mentors__swiper", {
    loop: true,
    centeredSlides: true,
    centeredSlidesBounds: true,
    effect: "coverflow",
    autoHeight: true,
    scrollable: true,
    watchSlidesProgress: true,
    preloadImages: false,
    lazy: {
      loadPrevNext: true,
      loadPrevNextAmount: 2,
    },
    coverflowEffect: {
      rotate: 0,
      stretch: 0,
      scale: 0.9,
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
        spaceBetween: 140,
      },
    },
  });
});
