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
    // Ensure swiper instance and slides exist
    if (
      !swiperInstance ||
      !swiperInstance.slides ||
      swiperInstance.slides.length === 0
    ) {
      console.warn("Robot Slider: No slides available");
      return;
    }

    // Get the active slide
    const activeSlide = swiperInstance.slides[swiperInstance.activeIndex];
    if (!activeSlide) {
      console.warn(
        "Robot Slider: No active slide found at index",
        swiperInstance.activeIndex
      );
      return;
    }

    // Check if all required DOM elements exist
    const robotName = document.getElementById("robot-name");
    const robotTeam = document.getElementById("robot-team");
    const robotAttack = document.getElementById("robot-attack");
    const robotDefense = document.getElementById("robot-defense");

    if (!robotName || !robotTeam || !robotAttack || !robotDefense) {
      console.warn("Robot Slider: One or more panel elements not found");
      return;
    }

    // Get data from active slide with fallbacks
    const title = activeSlide.dataset.title || "—";
    const team = activeSlide.dataset.team || "—";
    const attack = activeSlide.dataset.attack || "0";
    const defense = activeSlide.dataset.defense || "0";

    // Update panel with data
    robotName.textContent = title;
    robotTeam.textContent = team;
    robotAttack.textContent = attack;
    robotDefense.textContent = defense;

    console.log("Robot Slider: Panel updated with data:", {
      title,
      team,
      attack,
      defense,
    });
  }

  // Initialize slider only if the container exists
  const sliderContainer = document.querySelector(".rfc-robots__slider");
  if (!sliderContainer) {
    console.warn("Robot Slider: Container not found");
    return;
  }

  // Check if slides exist
  const slides = sliderContainer.querySelectorAll(".swiper-slide");
  if (slides.length === 0) {
    console.warn("Robot Slider: No slides found in container");
    return;
  }

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
      scale: 0.7,
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
        spaceBetween: 60,
      },
    },
    on: {
      init(swiper) {
        console.log("Robot Slider: Swiper initialized");
        // Add a small delay to ensure everything is ready
        setTimeout(() => {
          updateRobotPanel(swiper);
        }, 100);
      },
      slideChange: debounce(function (swiper) {
        updateRobotPanel(swiper);
      }, 100),
      // Additional event to catch cases where init doesn't work properly
      slidesUpdated(swiper) {
        console.log("Robot Slider: Slides updated");
        updateRobotPanel(swiper);
      },
    },
  });

  // Fallback: Try to update panel after a short delay if it's still empty
  setTimeout(() => {
    const robotName = document.getElementById("robot-name");
    if (
      robotName &&
      (robotName.textContent === "—" || robotName.textContent.trim() === "")
    ) {
      console.log("Robot Slider: Fallback update triggered");
      updateRobotPanel(robotSwiper);
    }
  }, 500);
});
