<?php

/**
 * RFC Mentors block (with Swiper.js & BEM + backdrop-filter fix)
 */
$mentor_ids = get_field('mentors');
if (!$mentor_ids) return;
?>

<section class="mentors">
  <div class="swiper mentors__swiper">
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

        <div class="swiper-slide mentors__card-wrapper">
          <div class="mentors__card-bg"></div>

          <div class="mentors__card">
            <img class="mentors__logo"
              src="<?php echo get_template_directory_uri(); ?>/images/logo.png"
              alt="<?php bloginfo('name'); ?>">

            <div class="mentors__photo-ring">
              <div class="mentors__photo">
                <?php if ($photo): ?>
                  <img class="mentors__image" src="<?php echo esc_url($photo['url']); ?>"
                    alt="<?php echo esc_attr($name); ?>">
                <?php else: ?>
                  <span class="mentors__image--placeholder">Фото</span>
                <?php endif; ?>
              </div>
            </div>


            <h3 class="mentors__name"><?php echo esc_html($name); ?></h3>
            <p class="mentors__description"><?php echo esc_html($description); ?></p>

            <div class="mentors__facts">
              <?php if ($fact1): ?>
                <span class="mentors__fact"><?php echo esc_html($fact1); ?></span>
              <?php endif; ?>
              <?php if ($fact2): ?>
                <span class="mentors__fact"><?php echo esc_html($fact2); ?></span>
              <?php endif; ?>
            </div>

            <button class="mentors__more">Узнать больше</button>

            <div class="mentors__modal-content">
              <div class="mentors__socials">
                <?php if ($telegram): ?>
                  <a class="mentors__social" href="<?php echo esc_url($telegram); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 44 44">
                      <path fill="url(#telegram-gradient)" d="M22 3.7a18.3 18.3 0 1 0 0 36.6 18.3 18.3 0 0 0 0-36.6ZM30.5 16c-.3 3-1.5 10-2 13.2-.3 1.4-.8 1.8-1.3 1.9-1 0-1.9-.7-3-1.4l-4-2.7c-1.8-1.2-.6-1.9.4-3 .3-.2 5-4.5 5-4.9a.4.4 0 0 0 0-.3h-.4c-.2 0-2.7 1.7-7.7 5-.8.6-1.4.8-2 .8-.7 0-2-.4-2.9-.7-1.1-.3-2-.5-2-1.2 0-.3.5-.6 1.4-1l10.7-4.6c5.1-2.1 6.1-2.5 6.8-2.5.2 0 .5 0 .8.2l.2.5v.7Z" />
                      <defs>
                        <linearGradient id="telegram-gradient" x1="0" y1="0" x2="1" y2="1" gradientUnits="objectBoundingBox">
                          <stop stop-color="#D53289" />
                          <stop offset="1" stop-color="#EA5234" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </a>
                <?php endif; ?>
                <?php if ($whatsapp): ?>
                  <a class="mentors__social" href="<?php echo esc_url($whatsapp); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 44 44">
                      <mask id="whatsapp-mask" width="36" height="36" x="4" y="4" maskUnits="userSpaceOnUse" style="mask-type:luminance">
                        <path fill="#fff" d="M4.6 4.6h34.8v34.8H4.6V4.6Z" />
                      </mask>
                      <g mask="url(#whatsapp-mask)">
                        <path fill="url(#whatsapp-gradient)" d="m25.3 4.8-1-.1A16.7 16.7 0 0 0 7.8 12a16.7 16.7 0 0 0-1.3 17.7 2.4 2.4 0 0 1 .2 1.9l-2.2 7.9.9-.3 7.4-2c.5 0 1 0 1.6.2A17.3 17.3 0 1 0 25.3 4.8Zm4.6 24a5 5 0 0 1-5 1.1c-3.8-1-7.2-3.5-9.4-6.8-.8-1.2-1.5-2.4-2-3.8a4.6 4.6 0 0 1 1-4.6 2.3 2.3 0 0 1 2.4-.8c.4.1.6.6 1 1 .2.8.5 1.5.9 2.3a1.7 1.7 0 0 1-.4 2.4c-.8.7-.7 1.3 0 2.1 1.2 1.9 3 3.4 5 4.3.7.2 1.1.3 1.5-.3l.6-.7c1-1.3.7-1.3 2.4-.6l1.5.8c.5.3 1.3.6 1.4 1a2.7 2.7 0 0 1-.9 2.7Z" />
                      </g>
                      <defs>
                        <linearGradient id="whatsapp-gradient" x1="0" y1="0" x2="1" y2="1" gradientUnits="objectBoundingBox">
                          <stop stop-color="#D53289" />
                          <stop offset="1" stop-color="#EA5234" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </a>
                <?php endif; ?>
                <?php if ($instagram): ?>
                  <a class="mentors__social" href="<?php echo esc_url($instagram); ?>" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 43 43">
                      <path fill="url(#instagram-gradient)" d="M23.3 3.6H29c1.9.2 3.2.5 4.3 1a8.8 8.8 0 0 1 5.2 5.2c.5 1.1.8 2.4 1 4.3V29c-.2 1.9-.5 3.2-1 4.3a8.8 8.8 0 0 1-2 3.2c-.9 1-2 1.6-3.2 2-1.1.5-2.4.8-4.3 1H14c-1.9-.2-3.2-.5-4.3-1a8.8 8.8 0 0 1-3.2-2c-1-.9-1.6-2-2-3.2-.5-1.1-.8-2.4-1-4.3V14c.2-1.9.5-3.2 1-4.3a8.8 8.8 0 0 1 2-3.2c.9-1 2-1.6 3.2-2 1.1-.5 2.4-.8 4.3-1h9.2Zm-1.8 9a9 9 0 1 0 0 17.9 9 9 0 0 0 0-18Zm0 3.5a5.4 5.4 0 1 1 0 10.8 5.4 5.4 0 0 1 0-10.8m9.4-6.2a2.2 2.2 0 1 0 0 4.4 2.2 2.2 0 0 0 0-4.4Z" />
                      <defs>
                        <linearGradient id="instagram-gradient" x1="0" y1="0" x2="1" y2="1" gradientUnits="objectBoundingBox">
                          <stop stop-color="#D53289" />
                          <stop offset="1" stop-color="#EA5234" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>

    <div class="mentors__buttons">
      <button class="mentors__button mentors__button--prev">
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
      <button class="mentors__button mentors__button--next">
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
  </div>
</section>