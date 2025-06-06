jQuery(document).ready(function ($) {
  // Универсальный рендер смены
  function renderShift(data) {
    return `
      <div class="shift-info">
        <h2 class="shift-info__title">${data.title}</h2>

        <div class="shift-info__top">
          <div class="shift-info__description">
            <h3 class="shift-info__subtitle">Описание занятий</h3>
            <p class="shift-info__text">${data.description}</p>
            <div class="shift-info__tags">
              <span class="shift-info__tag">${data.price}₽</span>
              <span class="shift-info__tag">${data.hours}</span>
            </div>
          </div>
          ${data.image ? `
            <div class="shift-info__image">
              <img src="${data.image.url}" alt="" />
            </div>` : ''}
        </div>

        <div class="shift-info__bottom">
          ${data.secondary_image ? `
            <div class="shift-info__image">
              <img src="${data.secondary_image.url}" alt="" />
            </div>` : ''}
          <div class="shift-info__description">
            <h3 class="shift-info__subtitle">Программа занятий</h3>
            <p class="shift-info__text">${data.program}</p>
          </div>
        </div>
      </div>
      <div class="shift-info__actions">
        <button 
          class="open-registration-form shift-info__button"
          data-camp-title="${data.title}"
          data-camp-city="${data.city}"
          data-camp-dates="${data.start_date} – ${data.end_date}"
        >
          Забронировать
        </button>
      </div>
    `;
  }


  // Подстановка значений в селекты
  function populateSelects(data) {
    $('.shift-filter').each(function () {
      const $select = $(this);
      const field = $select.data('field');
      if (data[field]) {
        $select.val(data[field]);
      }
    });
  }

  // Загрузка смены по умолчанию
  function loadDefaultShift() {
    $.post(shift_ajax.ajax_url, { action: 'get_default_shift' }, function (res) {
      if (res.success) {
        populateSelects(res.data);
        $('#shift-details').html(renderShift(res.data));
      }
    }, 'json');
  }

  // Загрузка смены по фильтру
  function loadShiftByField(field, value) {
    $.post(shift_ajax.ajax_url, {
      action: 'get_shift_by_field',
      field: field,
      value: value
    }, function (res) {
      if (res.success) {
        populateSelects(res.data);
        $('#shift-details').html(renderShift(res.data));
      } else {
        $('#shift-details').html('<p>Смена не найдена</p>');
      }
    }, 'json');
  }

  // Инициализация по умолчанию
  loadDefaultShift();

  // Обработка выбора фильтра
  $('.shift-filter').on('change', function () {
    const field = $(this).data('field');
    const value = $(this).val();
    if (value) {
      loadShiftByField(field, value);
    }
  });

  // Делегированный обработчик открытия модалки
  $(document).on('click', '.open-registration-form', function () {
    const title = $(this).data('camp-title') || '';
    const city = $('.shift-filter[data-field="city"]').find('option:selected').text() || '';
    const rawDates = $(this).data('camp-dates') || '';

    const [rawStart, rawEnd] = rawDates.split('–').map(s => s.trim());

    // Преобразуем даты
    function formatDate(raw) {
      if (!raw) return '';
      if (raw.includes('/')) {
        // формат DD/MM/YYYY
        const [d, m, y] = raw.split('/');
        return `${d.padStart(2, '0')}.${m.padStart(2, '0')}.${y}`;
      } else if (/^\d{8}$/.test(raw)) {
        // формат YYYYMMDD
        const y = raw.slice(0, 4);
        const m = raw.slice(4, 6);
        const d = raw.slice(6, 8);
        return `${d}.${m}.${y}`;
      }
      return raw; // fallback
    }

    const formattedStart = formatDate(rawStart);
    const formattedEnd = formatDate(rawEnd);
    const dateRange = `${formattedStart}–${formattedEnd}`;

    const summary = `Выбранная смена: ${title}, ${city}, ${dateRange}`;

    const $modal = $('#registration-modal');
    $modal.find('#camp-info').val(summary);
    $modal.find('#camp-info-display').text(summary);

    $modal.addClass('active');
    $('body').addClass('modal-open');
  });


  // Закрытие модалки
  $(document).on('click', '.registration-modal__overlay', function () {
    $('#registration-modal').removeClass('active');
    $('body').removeClass('modal-open');
  });

  // Закрытие по кнопке-крестику
  $(document).on('click', '.registration-modal__close', function () {
    $('#registration-modal').removeClass('active');
    $('body').removeClass('modal-open');
  });

  // Закрытие по клику вне wrapper
  $(document).on('click', '#registration-modal', function (e) {
    const $wrapper = $(this).find('.registration-modal__wrapper');

    if (!$wrapper.is(e.target) && $wrapper.has(e.target).length === 0) {
      $('#registration-modal').removeClass('active');
      $('body').removeClass('modal-open');
    }
  });
});
