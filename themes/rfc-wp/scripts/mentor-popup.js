document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('mentor-modal');
  const modalWrapper = modal.querySelector('.rfc-mentors__modal-wrapper');

  document.querySelectorAll('.rfc-mentors__more').forEach(button => {
    button.addEventListener('click', () => {
      const card = button.closest('.rfc-mentors__card');
      const clone = card.cloneNode(true);
      clone.classList.add('rfc-mentors__card--modal');

      // добавить кнопку закрытия
      const closeBtn = document.createElement('button');
      closeBtn.className = 'rfc-mentors__modal-close';
      closeBtn.innerHTML = `
      <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.25 23.75L15 15M15 15L23.75 6.25M15 15L6.25 6.25M15 15L23.75 23.75" stroke="#9D8F94" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      `;
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
  modal.querySelector('.rfc-mentors__modal-overlay').addEventListener('click', () => {
    modal.classList.remove('active');
    document.body.classList.remove('modal-open');
    modalWrapper.innerHTML = '';
  });
});
