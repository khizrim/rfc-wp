document.addEventListener("DOMContentLoaded", () => {
  const toggleButton = document.querySelector("[data-toggle-menu]");
  const mobileMenu = document.querySelector("[data-mobile-menu]");
  const body = document.body;

  if (!toggleButton || !mobileMenu) return;

  // Handle menu toggle
  const toggleMenu = () => {
    const isOpen = mobileMenu.classList.contains("mobile-menu--open");

    // Update ARIA attributes
    toggleButton.setAttribute("aria-expanded", !isOpen);
    toggleButton.setAttribute(
      "aria-label",
      isOpen ? "Открыть меню" : "Закрыть меню"
    );

    // Toggle classes
    mobileMenu.classList.toggle("mobile-menu--open");
    body.classList.toggle("mobile-menu--open");

    // Prevent body scroll when menu is open
    body.style.overflow = isOpen ? "" : "hidden";
  };

  // Handle click outside to close menu
  const handleClickOutside = (event) => {
    if (
      mobileMenu.classList.contains("mobile-menu--open") &&
      !mobileMenu.contains(event.target) &&
      !toggleButton.contains(event.target)
    ) {
      toggleMenu();
    }
  };

  // Handle escape key to close menu
  const handleEscapeKey = (event) => {
    if (
      event.key === "Escape" &&
      mobileMenu.classList.contains("mobile-menu--open")
    ) {
      toggleMenu();
    }
  };

  // Add event listeners
  toggleButton.addEventListener("click", toggleMenu);
  document.addEventListener("click", handleClickOutside);
  document.addEventListener("keydown", handleEscapeKey);

  // Handle menu links
  const menuLinks = mobileMenu.querySelectorAll(".mobile-menu__link");
  menuLinks.forEach((link) => {
    link.addEventListener("click", () => {
      if (mobileMenu.classList.contains("mobile-menu--open")) {
        toggleMenu();
      }
    });
  });

  // Handle callback button
  const callbackBtn = mobileMenu.querySelector(".mobile-menu__callback-btn");
  if (callbackBtn) {
    callbackBtn.addEventListener("click", () => {
      if (mobileMenu.classList.contains("mobile-menu--open")) {
        toggleMenu();
      }
    });
  }
});
