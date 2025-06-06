<?php

/**
 * RFC Cards Mix block
 */

$cards = get_field('cards');
if (!$cards) return;
?>

<section class="rfc-cards-mix">
    <?php foreach ($cards as $card): ?>
      <?php if ($card['type'] === 'text'): ?>
        <div class="rfc-cards-mix__card-border">
          <div class="rfc-cards-mix__card rfc-cards-mix__card--text">
            <?php if ($card['title']): ?>
              <h3 class="rfc-cards-mix__card-title"><?php echo esc_html($card['title']); ?></h3>
            <?php endif; ?>
            <?php if ($card['description']): ?>
              <p class="rfc-cards-mix__card-description"><?php echo esc_html($card['description']); ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php elseif ($card['type'] === 'image' && $card['image']): ?>
        <div class="rfc-cards-mix__card-border">
          <div class="rfc-cards-mix__card rfc-cards-mix__card--image">
            <img class="rfc-cards-mix__card-image" src="<?php echo esc_url($card['image']['url']); ?>" alt="">
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
</section>
