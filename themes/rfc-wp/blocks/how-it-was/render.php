<?php

/**
 * RFC How It Was block
 */

$slides = get_field('slides');
if (!$slides) return;
?>

<section class="rfc-how-it-was">
  <div class="rfc-hiw__content">
    <div class="rfc-hiw__header">
      <h3 class="rfc-hiw__title" id="hiw-title">—</h3>
      <div class="rfc-hiw__desktop-nav">
        <button class="rfc-hiw__button rfc-hiw__button--prev" aria-label="Предыдущий слайд">
          <span>
            <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.8" d="M11.7109 15.3525L0.999107 8.58449" stroke="white" stroke-linecap="round" />
              <path opacity="0.8" d="M11.7109 1.29248L0.999107 8.06053" stroke="white" stroke-linecap="round" />
              <path opacity="0.25" d="M22.4688 15.3525L11.7569 8.58449" stroke="white" stroke-linecap="round" />
              <path opacity="0.25" d="M22.4688 1.29248L11.7569 8.06053" stroke="white" stroke-linecap="round" />
              <g opacity="0.5">
                <path opacity="0.8" d="M16.4902 15.3525L5.7784 8.58449" stroke="white" stroke-linecap="round" />
                <path opacity="0.8" d="M16.4902 1.29248L5.7784 8.06053" stroke="white" stroke-linecap="round" />
              </g>
            </svg>
          </span>
        </button>
        <button class="rfc-hiw__button rfc-hiw__button--next" aria-label="Следующий слайд">
          <span>
            <svg width="28" height="16" viewBox="0 0 28 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path opacity="0.8" d="M14.2734 15.0449L27.2228 8.27688" stroke="white" stroke-linecap="round" />
              <path opacity="0.8" d="M14.2734 0.985107L27.2228 7.75315" stroke="white" stroke-linecap="round" />
              <path opacity="0.25" d="M1.26953 15.0449L14.2189 8.27688" stroke="white" stroke-linecap="round" />
              <path opacity="0.25" d="M1.26953 0.985107L14.2189 7.75315" stroke="white" stroke-linecap="round" />
              <g opacity="0.5">
                <path opacity="0.8" d="M8.49609 15.0449L21.4455 8.27688" stroke="white" stroke-linecap="round" />
                <path opacity="0.8" d="M8.49609 0.985107L21.4455 7.75315" stroke="white" stroke-linecap="round" />
              </g>
            </svg>
          </span>
        </button>
      </div>
    </div>
    <p class="rfc-hiw__description" id="hiw-description">—</p>
  </div>

  <div class="rfc-hiw__slider swiper">
    <div class="swiper-wrapper">
      <?php foreach ($slides as $slide): ?>
        <div class="rfc-hiw__slide swiper-slide"
          data-title="<?php echo esc_attr($slide['title']); ?>"
          data-description="<?php echo esc_attr($slide['description']); ?>">
          <figure class="rfc-hiw__image">
            <img src="<?php echo esc_url($slide['image']['url']); ?>"
              alt="<?php echo esc_attr($slide['title']); ?>">
          </figure>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="rfc-hiw__thumbs swiper">
    <div class="swiper-wrapper">
      <?php foreach ($slides as $slide): ?>
        <div class="rfc-hiw__thumb swiper-slide">
          <div class="rfc-hiw__thumb-image">
            <img src="<?php echo esc_url($slide['image']['url']); ?>"
              alt="<?php echo esc_attr($slide['title']); ?>">
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="rfc-hiw__mobile-nav">
    <button class="rfc-hiw__button rfc-hiw__button--prev" aria-label="Предыдущий слайд">
      <span>
        <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path opacity="0.8" d="M11.7109 15.3525L0.999107 8.58449" stroke="white" stroke-linecap="round" />
          <path opacity="0.8" d="M11.7109 1.29248L0.999107 8.06053" stroke="white" stroke-linecap="round" />
          <path opacity="0.25" d="M22.4688 15.3525L11.7569 8.58449" stroke="white" stroke-linecap="round" />
          <path opacity="0.25" d="M22.4688 1.29248L11.7569 8.06053" stroke="white" stroke-linecap="round" />
          <g opacity="0.5">
            <path opacity="0.8" d="M16.4902 15.3525L5.7784 8.58449" stroke="white" stroke-linecap="round" />
            <path opacity="0.8" d="M16.4902 1.29248L5.7784 8.06053" stroke="white" stroke-linecap="round" />
          </g>
        </svg>
      </span>
    </button>
    <button class="rfc-hiw__button rfc-hiw__button--next" aria-label="Следующий слайд">
      <span>
        <svg width="28" height="16" viewBox="0 0 28 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path opacity="0.8" d="M14.2734 15.0449L27.2228 8.27688" stroke="white" stroke-linecap="round" />
          <path opacity="0.8" d="M14.2734 0.985107L27.2228 7.75315" stroke="white" stroke-linecap="round" />
          <path opacity="0.25" d="M1.26953 15.0449L14.2189 8.27688" stroke="white" stroke-linecap="round" />
          <path opacity="0.25" d="M1.26953 0.985107L14.2189 7.75315" stroke="white" stroke-linecap="round" />
          <g opacity="0.5">
            <path opacity="0.8" d="M8.49609 15.0449L21.4455 8.27688" stroke="white" stroke-linecap="round" />
            <path opacity="0.8" d="M8.49609 0.985107L21.4455 7.75315" stroke="white" stroke-linecap="round" />
          </g>
        </svg>
      </span>
    </button>
  </div>
</section>
