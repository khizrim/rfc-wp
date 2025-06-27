<?php

/**
 * RFC Mentors block (with Swiper.js & BEM + backdrop-filter fix)
 */
$mentor_ids = get_field('mentors');
if (!$mentor_ids) return;

if (count($mentor_ids) === 3) {
  $mentor_ids = array_merge($mentor_ids, $mentor_ids);
}
?>



<section class="rfc-mentors">
  <div class="swiper rfc-mentors__swiper">
    <div class="swiper-wrapper">

      <?php foreach ($mentor_ids as $post_id): ?>
        <?php
        $name        = get_the_title($post_id);
        $photo       = get_field('photo', $post_id);
        $fact1       = get_field('fact_1', $post_id);
        $fact2       = get_field('fact_2', $post_id);
        $description = get_field('description', $post_id);
        $telegram    = get_field('telegram_url', $post_id);
        $whatsapp    = get_field('whatsapp_url', $post_id);
        $instagram   = get_field('instagram_url', $post_id);
        ?>

        <div class="swiper-slide rfc-mentors__card-wrapper">
          <div class="rfc-mentors__card-bg"></div>

          <div class="rfc-mentors__card">
            <img class="rfc-mentors__logo"
              src="<?php echo get_template_directory_uri(); ?>/images/logo.png"
              alt="<?php bloginfo('name'); ?>">

            <div class="rfc-mentors__photo-ring">
              <div class="rfc-mentors__photo">
                <?php if ($photo): ?>
                  <img class="rfc-mentors__image" src="<?php echo esc_url($photo['url']); ?>"
                    alt="<?php echo esc_attr($name); ?>">
                <?php else: ?>
                  <span class="rfc-mentors__image--placeholder">Фото</span>
                <?php endif; ?>
              </div>
            </div>


            <h3 class="rfc-mentors__name"><?php echo esc_html($name); ?></h3>
            <p class="rfc-mentors__description"><?php echo esc_html($description); ?></p>

            <div class="rfc-mentors__facts">
              <?php if ($fact1): ?>
                <span class="rfc-mentors__fact"><?php echo esc_html($fact1); ?></span>
              <?php endif; ?>
              <?php if ($fact2): ?>
                <span class="rfc-mentors__fact"><?php echo esc_html($fact2); ?></span>
              <?php endif; ?>
            </div>

            <button class="rfc-mentors__more">Узнать больше</button>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>