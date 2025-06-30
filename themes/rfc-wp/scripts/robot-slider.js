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

    // Check if all required DOM elements exist
    const robotName = document.getElementById("robot-name");
    const robotTeam = document.getElementById("robot-team");
    const robotAttack = document.getElementById("robot-attack");
    const robotDefense = document.getElementById("robot-defense");

    if (!robotName || !robotTeam || !robotAttack || !robotDefense) {
      console.warn("Robot Slider: One or more panel elements not found");
      return;
    }

    // Get the real active index for loop mode
    let realIndex =
      swiperInstance.realIndex !== undefined
        ? swiperInstance.realIndex
        : swiperInstance.activeIndex;

    // Find all original slides (not clones)
    const originalSlides = Array.from(swiperInstance.slides).filter(
      (slide) => !slide.classList.contains("swiper-slide-duplicate")
    );

    // Get the active slide from original slides
    const activeSlide = originalSlides[realIndex];

    if (!activeSlide) {
      console.warn(
        "Robot Slider: No active slide found at real index",
        realIndex
      );
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
  }

  // Helper function to check if panel has data
  function isPanelEmpty() {
    const robotName = document.getElementById("robot-name");
    const robotTeam = document.getElementById("robot-team");
    const robotAttack = document.getElementById("robot-attack");
    const robotDefense = document.getElementById("robot-defense");

    return (
      !robotName ||
      !robotTeam ||
      !robotAttack ||
      !robotDefense ||
      robotName.textContent === "—" ||
      robotName.textContent.trim() === "" ||
      robotTeam.textContent === "—" ||
      robotAttack.textContent === "0" ||
      robotDefense.textContent === "0"
    );
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
        // Add a longer delay to ensure everything is ready
        setTimeout(() => {
          updateRobotPanel(swiper);
        }, 200);
      },
      slideChange: debounce(function (swiper) {
        updateRobotPanel(swiper);
      }, 100),
      // Additional events to catch various initialization states
      slidesUpdated(swiper) {
        updateRobotPanel(swiper);
      },
      loopFix(swiper) {
        updateRobotPanel(swiper);
      },
      click() {
        if (this.clickedIndex !== this.activeIndex) {
          robotSwiper.slideTo(this.clickedIndex);
        }
      },
    },
  });

  // Multiple fallback attempts with increasing delays
  const fallbackAttempts = [300, 600, 1000];

  fallbackAttempts.forEach((delay, index) => {
    setTimeout(() => {
      if (isPanelEmpty()) {
        console.log(
          `Robot Slider: Fallback attempt ${index + 1} at ${delay}ms`
        );
        updateRobotPanel(robotSwiper);
      }
    }, delay);
  });
});
