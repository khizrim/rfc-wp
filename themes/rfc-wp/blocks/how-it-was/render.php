<?php

/**
 * RFC How It Was block
 */

$slides = get_field('slides');
if (!$slides) return;
?>

<section class="rfc-how-it-was">
  <h2 class="rfc-hiw__headline">КАК ЭТО БЫЛО?</h2>
  <div class="rfc-hiw__slider">
    <?php foreach ($slides as $slide): ?>
      <div class="rfc-hiw__slide">
        <div class="rfc-hiw__text">
          <h3 class="rfc-hiw__title"><?php echo esc_html($slide['title']); ?></h3>
          <p class="rfc-hiw__description"><?php echo esc_html($slide['description']); ?></p>
        </div>
        <?php if ($slide['image']): ?>
          <div class="rfc-hiw__image">
            <img src="<?php echo esc_url($slide['image']['url']); ?>" alt="<?php echo esc_attr($slide['title']); ?>">
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>
