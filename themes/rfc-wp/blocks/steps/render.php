<?php

/**
 * RFC Steps block
 */

$steps = get_field('steps');
?>

<section class="rfc-steps">
  <div class="rfc-steps__inner">
    <?php foreach ($steps as $index => $step): ?>
      <div class="rfc-step rfc-step--<?php echo esc_attr($step['color']); ?>">
        <div class="rfc-step__number"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></div>
        <div class="rfc-step__content">
          <h3 class="rfc-step__title"><?php echo esc_html($step['title']); ?></h3>
          <p class="rfc-step__description"><?php echo esc_html($step['description']); ?></p>
        </div>
        <?php if (!empty($step['image'])): ?>
          <div class="rfc-step__image">
            <img src="<?php echo esc_url($step['image']['url']); ?>" alt="<?php echo esc_attr($step['image']['alt']); ?>" />
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>
