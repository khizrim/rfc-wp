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
</section>