document.addEventListener('DOMContentLoaded', () => {
  const toggleButton = document.querySelector('[data-toggle-menu]');
  const mobileMenu = document.querySelector('[data-mobile-menu]');

  if (toggleButton && mobileMenu) {
    toggleButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('mobile-menu--open');
    });
  }
});
