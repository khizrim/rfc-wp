<?php
/**
 * RFC Robots block
 */

$robot_ids = get_field('robots');
if (!$robot_ids) return;
?>

<section class="rfc-robots">
  <div class="rfc-robots__visual">
    <div class="swiper rfc-robots__slider">
      <div class="swiper-wrapper">
        <?php foreach ($robot_ids as $post_id): ?>
          <?php
            $title = get_the_title($post_id);
            $image = get_field('photo', $post_id);
            $team = get_field('team', $post_id);
            $attack = get_field('attack_points', $post_id);
            $defense = get_field('defense_points', $post_id);
          ?>
          <div class="swiper-slide" 
               data-title="<?php echo esc_attr($title); ?>" 
               data-team="<?php echo esc_attr($team); ?>" 
               data-attack="<?php echo esc_attr($attack); ?>" 
               data-defense="<?php echo esc_attr($defense); ?>">
            <?php if ($image): ?>
              <img src="<?php echo esc_url($image['url']); ?>" class="rfc-robot__image" alt="">
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <div class="rfc-robots__panel">
    <h3 id="robot-name">—</h3>
    <p id="robot-team">—</p>
    <div class="rfc-robot__stats">
      <div><strong id="robot-attack">0</strong><span>Очков атаки</span></div>
      <div><strong id="robot-defense">0</strong><span>Очков защиты</span></div>
    </div>
  </div>

  <!-- Навигация -->
  <button class="rfc-robots__nav rfc-robots__nav--prev">«</button>
  <button class="rfc-robots__nav rfc-robots__nav--next">»</button>
</section>
