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
    <button class="rfc-robots__button rfc-robots__button--next">
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
