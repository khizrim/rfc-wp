document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("callback-modal");
  const wrapper = modal.querySelector(".callback-modal__wrapper");

  console.log("Callback modal and wrapper initialized:", modal, wrapper);
  if (!modal || !wrapper) {
    console.error("Callback modal or wrapper not found");
    return;
  }

  // Обработчик для кнопок открытия попапа обратного звонка
  document.querySelectorAll(".open-callback-form").forEach((button) => {
    console.log(`Callback button found: ${button.textContent.trim()}`);

    button.addEventListener("click", () => {
      modal.classList.add("active");
      document.body.classList.add("modal-open");
    });
  });

  // Закрытие попапа по клику на overlay
  modal
    .querySelector(".callback-modal__overlay")
    .addEventListener("click", () => {
      modal.classList.remove("active");
      document.body.classList.remove("modal-open");
    });

  // Закрытие попапа по клику вне wrapper
  modal.addEventListener("click", (e) => {
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
