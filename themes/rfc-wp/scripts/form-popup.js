document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('registration-modal');
  const wrapper = modal.querySelector('.registration-modal__wrapper');

  console.log('Modal and wrapper initialized:', modal, wrapper);
  if (!modal || !wrapper) {
    console.error('Modal or wrapper not found');
    return;
  }

  document.querySelectorAll('.open-registration-form').forEach(button => {
    console.log(`Button found: ${button.textContent.trim()}`);
    
    button.addEventListener('click', () => {
      const title = button.getAttribute('data-camp-title') || '';
      const city = button.getAttribute('data-camp-city') || '';
      const dates = button.getAttribute('data-camp-dates') || '';

      const summary = `${title}, ${city}, ${dates}`;

      // вставляем значение в hidden-поле Contact Form 7
      const hiddenInput = modal.querySelector('#camp-info');
      if (hiddenInput) {
        hiddenInput.value = summary;
      }

      modal.classList.add('active');
      document.body.classList.add('modal-open');
    });
  });

  // закрытие формы
  modal.querySelector('.registration-modal__overlay').addEventListener('click', () => {
    modal.classList.remove('active');
    document.body.classList.remove('modal-open');
  });
});
