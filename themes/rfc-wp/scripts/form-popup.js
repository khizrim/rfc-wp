document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("registration-modal");
  const wrapper = modal?.querySelector(".registration-modal__wrapper");

  const registrationButtons = document.querySelectorAll(
    ".open-registration-form"
  );

  registrationButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const title = button.getAttribute("data-camp-title") || "";
      const city = button.getAttribute("data-camp-city") || "";
      const dates = button.getAttribute("data-camp-dates") || "";

      const summary = `${title}, ${city}, ${dates}`;

      // вставляем значение в hidden-поле Contact Form 7
      const hiddenInput = modal.querySelector("#camp-info");
      if (hiddenInput) {
        hiddenInput.value = summary;
      }

      modal.classList.add("active");
      document.body.classList.add("modal-open");
    });
  });

  // Закрытие при клике на overlay
  modal
    ?.querySelector(".registration-modal__overlay")
    ?.addEventListener("click", function () {
      modal.classList.remove("active");
      document.body.classList.remove("modal-open");
    });

  // Закрытие при клике вне wrapper
  modal?.addEventListener("click", function (e) {
    if (!wrapper.contains(e.target)) {
      modal.classList.remove("active");
      document.body.classList.remove("modal-open");
    }
  });
});
