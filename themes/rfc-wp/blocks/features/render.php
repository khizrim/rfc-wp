<?php

/**
 * RFC Features block
 */

$items = get_field('items');
?>

<section class="rfc-features">
  <div class="rfc-features__inner">
    <?php foreach ($items as $item): ?>
      <div class="rfc-feature">
        <div class="rfc-feature__content">
        <div class="rfc-feature__icon rfc-feature__icon--<?php echo esc_attr($item['icon_color']); ?>">
          <?php echo $item['icon']; ?>
        </div>
        <h3 class="rfc-feature__title"><?php echo esc_html($item['title']); ?></h3>
        <p class="rfc-feature__description"><?php echo esc_html($item['description']); ?></p>        </div>
      </div>

    <?php endforeach; ?>
  </div>
</section>
