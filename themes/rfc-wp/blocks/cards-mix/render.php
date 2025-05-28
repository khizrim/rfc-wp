<?php

/**
 * RFC Cards Mix block
 */

$cards = get_field('cards');
if (!$cards) return;
?>

<section class="rfc-cards-mix">
  <div class="rfc-cards-grid">
    <?php foreach ($cards as $card): ?>
      <?php if ($card['type'] === 'text'): ?>
        <div class="rfc-card rfc-card--text">
          <?php if ($card['title']): ?>
            <h3 class="rfc-card__title"><?php echo esc_html($card['title']); ?></h3>
          <?php endif; ?>
          <?php if ($card['description']): ?>
            <p class="rfc-card__description"><?php echo esc_html($card['description']); ?></p>
          <?php endif; ?>
        </div>
      <?php elseif ($card['type'] === 'image' && $card['image']): ?>
        <div class="rfc-card rfc-card--image">
          <img src="<?php echo esc_url($card['image']['url']); ?>" alt="">
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</section>
