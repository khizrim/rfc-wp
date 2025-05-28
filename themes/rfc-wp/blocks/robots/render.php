<?php
/**
 * RFC Robots block
 */

$robot_ids = get_field('robots');
if (!$robot_ids) return;
?>

<section class="rfc-robots">
  <div class="rfc-robots__track">
    <?php foreach ($robot_ids as $post_id): ?>
      <?php
        $title = get_the_title($post_id);
        $image = get_field('image', $post_id);
        $team = get_field('team', $post_id);
        $attack = get_field('attack', $post_id);
        $defense = get_field('defense', $post_id);
      ?>
      <div class="rfc-robot">
        <?php if ($image): ?>
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="rfc-robot__image">
        <?php endif; ?>
        <div class="rfc-robot__info">
          <h3 class="rfc-robot__name"><?php echo esc_html($title); ?></h3>
          <p class="rfc-robot__team"><?php echo esc_html($team); ?></p>
          <div class="rfc-robot__stats">
            <div><strong><?php echo esc_html($attack); ?></strong><span>Очков атаки</span></div>
            <div><strong><?php echo esc_html($defense); ?></strong><span>Очков защиты</span></div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
