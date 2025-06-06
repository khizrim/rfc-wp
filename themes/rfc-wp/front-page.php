<?php

/**
 * Template Name: Главная страница темы
 */
get_header();

// Получаем все смены один раз
$posts = get_posts(['post_type' => 'camp_shift', 'posts_per_page' => -1]);

/**
 * Получение уникальных значений поля ACF
 */
function get_unique_field_options($posts, $field_name, $is_acf_select = false) {
  $unique = [];

  foreach ($posts as $post) {
    $value = get_field($field_name, $post->ID);

    if ($is_acf_select && is_array($value)) {
      $label = $value['label'] ?? '';
      $value = $value['value'] ?? '';
    } else {
      $label = $value;
    }

    if ($value && !isset($unique[$value])) {
      $unique[$value] = $label;
    }
  }

  return $unique;
}

/**
 * Генерация <option> элементов
 */
function render_options($options) {
  foreach ($options as $value => $label) {
    echo "<option value='" . esc_attr($value) . "'>" . esc_html($label) . "</option>";
  }
}

/**
 * Генерация отсортированных опций по дате
 */
function generate_date_options($posts, $field_name, $input_format = 'd/m/Y', $output_format = 'd.m.Y') {
  $dates = [];

  foreach ($posts as $post) {
    $raw = get_field($field_name, $post->ID);
    $date = DateTime::createFromFormat($input_format, $raw);
    if ($date) {
      $value = $date->format('Ymd');
      $label = $date->format($output_format);
      $dates[$value] = $label;
    }
  }

  ksort($dates);
  render_options($dates);
}
?>

<main class="main">
  <div class="main__inner">
    <?php the_content(); ?>

    <div class="shift" id="shift">
      <h2 class="shift__title section-heading section-heading__text">
        Выбери <mark>удобную смену!</mark>
      </h2>

      <div class="shift__filters">
        <?php
        function render_filter($label, $field, $options) {
        ?>
          <div class="shift-filter-wrapper">
            <select class="shift-filter" data-field="<?= esc_attr($field); ?>">
              <option value=""><?= esc_html($label); ?></option>
              <?php render_options($options); ?>
            </select>
            <span class="shift-filter-arrow"></span>
          </div>
        <?php
        }

        render_filter('Город', 'city', get_unique_field_options($posts, 'city', true));
        render_filter('Адрес', 'address', get_unique_field_options($posts, 'address'));
        render_filter('Возраст', 'age_range', get_unique_field_options($posts, 'age_range'));
        ?>

        <div class="shift-filter-wrapper">
          <select class="shift-filter" data-field="start_date">
            <option value="">Дата начала</option>
            <?php generate_date_options($posts, 'start_date'); ?>
          </select>
          <span class="shift-filter-arrow"></span>
        </div>
      </div>


      <div id="shift-details" class="shift__details">
        <!-- сюда подставим карточку смены -->
      </div>
    </div>

    <div class="registration-modal" id="registration-modal">
      <div class="registration-modal__overlay"></div>
      <div class="registration-modal__wrapper">
        <div class="registration-modal__content">
          <h2 class="registration-modal__title">Оставь заявку!</h2>
          <p class="registration-modal__subtitle">
            Оставь заявку и мы свяжемся с тобой в ближайшее время для подтверждения брони!
          </p>
          <div class="registration-modal__form">
            <?php echo do_shortcode('[contact-form-7 id="08b1275" title="Форма пробного периода"]'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>