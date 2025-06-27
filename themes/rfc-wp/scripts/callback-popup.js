document.addEventListener("DOMContentLoaded", function () {
  const modal = document.getElementById("callback-modal");
  const wrapper = modal?.querySelector(".callback-modal__wrapper");

  const callbackButtons = document.querySelectorAll(".open-callback-form");

  callbackButtons.forEach((button) => {
    button.addEventListener("click", function () {
      modal.classList.add("active");
      document.body.classList.add("modal-open");
    });
  });

  // Закрытие при клике на overlay
  modal
    ?.querySelector(".callback-modal__overlay")
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

  // Закрытие попапа по нажатию клавиши Escape
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal.classList.contains("active")) {
      modal.classList.remove("active");
      document.body.classList.remove("modal-open");
    }
  });
});
