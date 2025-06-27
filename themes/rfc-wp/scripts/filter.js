document.addEventListener("DOMContentLoaded", function () {
  jQuery(document).ready(function ($) {
    // Флаг для предотвращения множественных запросов
    let isUpdating = false;

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
            ${
              data.image
                ? `
              <div class="shift-info__image">
                <img src="${data.image.url}" alt="" />
              </div>`
                : ""
            }
          </div>

          <div class="shift-info__bottom">
            ${
              data.secondary_image
                ? `
              <div class="shift-info__image">
                <img src="${data.secondary_image.url}" alt="" />
              </div>`
                : ""
            }
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

    // Обновление опций в селекте с сохранением выбранного значения
    function updateSelectOptions($select, options, placeholder) {
      const currentValue = $select.val();
      const fieldName = $select.data("field");

      $select.html(`<option value="">${placeholder}</option>`);

      for (const [value, label] of Object.entries(options)) {
        $select.append(`<option value="${value}">${label}</option>`);
      }

      // Восстанавливаем значение, если оно еще доступно
      if (currentValue && options.hasOwnProperty(currentValue)) {
        $select.val(currentValue);
      }
    }

    // Обновление всех фильтров на основе текущих выбранных значений
    function updateAllFilters(changedField = null) {
      const filters = getCurrentFilters();

      $.post(
        shift_ajax.ajax_url,
        {
          action: "get_available_options",
          ...filters,
        },
        function (res) {
          if (res.success) {
            const data = res.data;

            // Обновляем каждый селект, кроме того, который был изменен
            if (changedField !== "city") {
              updateSelectOptions(
                $('.shift-filter[data-field="city"]'),
                data.cities,
                "Город"
              );
            }

            if (changedField !== "address") {
              updateSelectOptions(
                $('.shift-filter[data-field="address"]'),
                data.addresses,
                "Адрес"
              );
            }

            if (changedField !== "age_range") {
              updateSelectOptions(
                $('.shift-filter[data-field="age_range"]'),
                data.age_ranges,
                "Возраст"
              );
            }

            if (changedField !== "start_date") {
              updateSelectOptions(
                $('.shift-filter[data-field="start_date"]'),
                data.start_dates,
                "Дата начала"
              );
            }
          }
        },
        "json"
      );
    }

    // Сбор всех текущих значений фильтров
    function getCurrentFilters() {
      const filters = {};
      $(".shift-filter").each(function () {
        const field = $(this).data("field");
        const value = $(this).val();
        if (value) {
          filters[field] = value;
        }
      });

      return filters;
    }

    // Функция для плавного обновления контента
    function updateShiftContent(newContent) {
      const $container = $("#shift-details");

      // Добавляем класс для плавного исчезновения
      $container.addClass("fade-in");

      // Ждем завершения анимации исчезновения, затем обновляем контент
      setTimeout(() => {
        $container.html(newContent);

        // Запускаем анимацию появления
        requestAnimationFrame(() => {
          $container.addClass("show");
        });

        // Убираем классы после завершения анимации
        setTimeout(() => {
          $container.removeClass("fade-in show");
        }, 300);
      }, 150);
    }

    // Загрузка смены по умолчанию
    function loadDefaultShift() {
      if (isUpdating) return;

      isUpdating = true;
      const $container = $("#shift-details");
      $container.addClass("loading");

      $.post(
        shift_ajax.ajax_url,
        { action: "get_default_shift" },
        function (res) {
          $container.removeClass("loading");
          isUpdating = false;

          if (res.success) {
            updateShiftContent(renderShift(res.data));
          }
        },
        "json"
      ).fail(function () {
        $container.removeClass("loading");
        isUpdating = false;
      });
    }

    // Комплексная фильтрация смен
    function filterShifts() {
      if (isUpdating) return;

      isUpdating = true;
      const filters = getCurrentFilters();
      const $container = $("#shift-details");

      $container.addClass("loading");

      $.post(
        shift_ajax.ajax_url,
        {
          action: "filter_shifts",
          ...filters,
        },
        function (res) {
          $container.removeClass("loading");
          isUpdating = false;

          if (res.success) {
            updateShiftContent(renderShift(res.data));
          } else {
            updateShiftContent("<p>Смена не найдена</p>");
          }
        },
        "json"
      ).fail(function () {
        $container.removeClass("loading");
        isUpdating = false;
      });
    }

    // Инициализация: загружаем смену по умолчанию и доступные опции
    loadDefaultShift();
    updateAllFilters();

    // Обработка изменения любого фильтра
    $(".shift-filter").on("change", function () {
      if (isUpdating) return;

      const field = $(this).data("field");
      const newValue = $(this).val();

      // Обновляем доступные опции в других фильтрах
      updateAllFilters(field);

      // Применяем фильтрацию или загружаем смену по умолчанию
      const filters = getCurrentFilters();

      if (Object.keys(filters).length > 0) {
        filterShifts();
      } else {
        loadDefaultShift();
      }
    });

    // Обработчик сброса фильтров
    $("#reset-filters").on("click", function () {
      if (isUpdating) return;

      // Сбрасываем все селекты
      $(".shift-filter").each(function () {
        $(this).val("");
      });

      // Обновляем доступные опции (загружаем все варианты)
      updateAllFilters();

      // Загружаем смену по умолчанию
      loadDefaultShift();
    });

    // Делегированный обработчик открытия модалки
    $(document).on("click", ".open-registration-form", function () {
      const title = $(this).data("camp-title") || "";
      const city =
        $('.shift-filter[data-field="city"]').find("option:selected").text() ||
        "";
      const rawDates = $(this).data("camp-dates") || "";

      const [rawStart, rawEnd] = rawDates.split("–").map((s) => s.trim());

      // Преобразуем даты
      function formatDate(raw) {
        if (!raw) return "";
        if (raw.includes("/")) {
          // формат DD/MM/YYYY
          const [d, m, y] = raw.split("/");
          return `${d.padStart(2, "0")}.${m.padStart(2, "0")}.${y}`;
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

      const $modal = $("#registration-modal");
      $modal.find("#camp-info").val(summary);
      $modal.find("#camp-info-display").text(summary);

      $modal.addClass("active");
      $("body").addClass("modal-open");
    });

    // Закрытие модалки
    $(document).on("click", ".registration-modal__overlay", function () {
      $("#registration-modal").removeClass("active");
      $("body").removeClass("modal-open");
    });

    // Закрытие по кнопке-крестику
    $(document).on("click", ".registration-modal__close", function () {
      $("#registration-modal").removeClass("active");
      $("body").removeClass("modal-open");
    });

    // Закрытие по клику вне wrapper
    $(document).on("click", "#registration-modal", function (e) {
      const $wrapper = $(this).find(".registration-modal__wrapper");

      if (!$wrapper.is(e.target) && $wrapper.has(e.target).length === 0) {
        $("#registration-modal").removeClass("active");
        $("body").removeClass("modal-open");
      }
    });
  });
});
