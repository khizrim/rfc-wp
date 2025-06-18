<?php

/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<main class="main">
  <div class="main__inner">
    <div class="not-found">
      <h1 class="not-found__title rfc-section-heading rfc-section-heading__text">
        Упс! Страница не найдена
      </h1>

      <div class="not-found__content">
        <p class="not-found__text">
          Такой страницы не существует. Вы можете вернуться на главную и почитать про наши школы
        </p>

        <div class="not-found__actions">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="button">
            Вернуться на главную
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>