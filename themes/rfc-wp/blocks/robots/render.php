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
          <div class="swiper-slide rfc-robot"
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
    <div class="rfc-robot__info">
      <h3 id="robot-name" class="robot-name">—</h3>
      <p id="robot-team" class="robot-team">—</p>
    </div>
    <div class="rfc-robot__stats">
      <div><strong id="robot-attack" class="robot-stat">0</strong><span class="robot-stat__label">Очков атаки</span></div>
      <div><strong id="robot-defense" class="robot-stat">0</strong><span class="robot-stat__label">Очков защиты</span></div>
    </div>

    <button class="rfc-robots__button rfc-robots__button--prev">
      <span>
        <svg width="29" height="15" viewBox="0 0 29 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M28.1171 0.298995C27.7185 -0.0996651 27.0724 -0.0996649 26.6738 0.298995L20.5488 6.424C20.3573 6.61544 20.25 6.87493 20.25 7.14567C20.25 7.41642 20.3573 7.67591 20.5488 7.86735L26.6738 13.9924C27.0724 14.391 27.7185 14.391 28.1171 13.9924C28.5158 13.5937 28.5158 12.9477 28.1171 12.549L22.7138 7.14567L28.1171 1.74235C28.5158 1.34369 28.5158 0.697655 28.1171 0.298995Z" fill="white" />
          <path d="M17.9921 0.298995C17.5935 -0.0996651 16.9474 -0.0996649 16.5488 0.298995L10.4238 6.424C10.2323 6.61544 10.125 6.87493 10.125 7.14567C10.125 7.41642 10.2323 7.67591 10.4238 7.86735L16.5488 13.9924C16.9474 14.391 17.5935 14.391 17.9921 13.9924C18.3908 13.5937 18.3908 12.9477 17.9921 12.549L12.5888 7.14567L17.9921 1.74235C18.3908 1.34369 18.3908 0.697655 17.9921 0.298995Z" fill="white" />
          <path d="M7.86714 0.298995C7.46848 -0.0996651 6.82244 -0.0996649 6.42378 0.298995L0.298783 6.424C0.10734 6.61544 -4.46306e-05 6.87493 -4.48227e-05 7.14567C-4.4806e-05 7.41642 0.10734 7.67591 0.298783 7.86735L6.42378 13.9924C6.82244 14.391 7.46848 14.391 7.86714 13.9924C8.2658 13.5937 8.2658 12.9477 7.86714 12.549L2.46382 7.14567L7.86714 1.74235C8.2658 1.34369 8.2658 0.697655 7.86714 0.298995Z" fill="white" />
        </svg>
      </span>
    </button>
    <button class="rfc-robots__button rfc-robots__button--next">
      <span>
        <svg width="30" height="16" viewBox="0 0 30 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.27837 1.27849C1.67703 0.879827 2.32306 0.879827 2.72172 1.27849L8.84672 7.40349C9.03817 7.59493 9.14555 7.85443 9.14555 8.12517C9.14555 8.39591 9.03817 8.6554 8.84672 8.84685L2.72172 14.9718C2.32306 15.3705 1.67703 15.3705 1.27837 14.9718C0.879705 14.5732 0.879705 13.9271 1.27837 13.5285L6.68169 8.12517L1.27837 2.72185C0.879705 2.32319 0.879705 1.67715 1.27837 1.27849Z" fill="white" />
          <path d="M11.4034 1.27849C11.802 0.879827 12.4481 0.879827 12.8467 1.27849L18.9717 7.40349C19.1632 7.59493 19.2706 7.85443 19.2706 8.12517C19.2706 8.39591 19.1632 8.6554 18.9717 8.84685L12.8467 14.9718C12.4481 15.3705 11.802 15.3705 11.4034 14.9718C11.0047 14.5732 11.0047 13.9271 11.4034 13.5285L16.8067 8.12517L11.4034 2.72185C11.0047 2.32319 11.0047 1.67715 11.4034 1.27849Z" fill="white" />
          <path d="M21.5284 1.27849C21.927 0.879827 22.5731 0.879827 22.9717 1.27849L29.0967 7.40349C29.2882 7.59493 29.3956 7.85443 29.3956 8.12517C29.3956 8.39591 29.2882 8.6554 29.0967 8.84685L22.9717 14.9718C22.5731 15.3705 21.927 15.3705 21.5284 14.9718C21.1297 14.5732 21.1297 13.9271 21.5284 13.5285L26.9317 8.12517L21.5284 2.72185C21.1297 2.32319 21.1297 1.67715 21.5284 1.27849Z" fill="white" />
        </svg>
      </span>
    </button>
  </div>
</section>