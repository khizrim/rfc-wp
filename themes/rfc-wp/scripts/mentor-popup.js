document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('mentor-modal');
  const modalWrapper = modal.querySelector('.mentors__modal-wrapper');

  document.querySelectorAll('.mentors__more').forEach(button => {
    button.addEventListener('click', () => {
      const card = button.closest('.mentors__card');
      const clone = card.cloneNode(true);
      clone.classList.add('mentors__card--modal');

      // добавить кнопку закрытия
      const closeBtn = document.createElement('button');
      closeBtn.className = 'mentors__modal-close';
      closeBtn.innerHTML = '&times;';
      closeBtn.addEventListener('click', () => {
        modal.classList.remove('active');
        document.body.classList.remove('modal-open');
        modalWrapper.innerHTML = '';
      });

      clone.appendChild(closeBtn);
      modalWrapper.innerHTML = ''; // очистка
      modalWrapper.appendChild(clone);

      modal.classList.add('active');
      document.body.classList.add('modal-open');
    });
  });

  // клик вне карточки
  modal.querySelector('.mentors__modal-overlay').addEventListener('click', () => {
    modal.classList.remove('active');
    document.body.classList.remove('modal-open');
    modalWrapper.innerHTML = '';
  });
});
