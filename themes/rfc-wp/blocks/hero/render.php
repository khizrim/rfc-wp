<?php

/**
 * RFC Hero block
 */

$image = get_field('background_image');
$badges = get_field('badges');
$title = get_field('title');
$button_text = get_field('button_text');
$button_subtext = get_field('button_subtext');
?>

<section class="rfc-hero">
  <div class="rfc-hero__container">
    <div class="rfc-hero__bg-container">
      <div class="rfc-hero__bg">
        <?php if ($image): ?>
          <img src="<?php echo esc_url($image['url']); ?>" alt="" class="rfc-hero__img" />
        <?php endif; ?>
        <div class="rfc-hero__bg-overlay"></div>
        <span class="rfc-hero__bg-squares">
          <svg width="46" height="42" viewBox="0 0 46 42" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect opacity="0.5" x="16.5" y="4.5" width="13" height="13" rx="1.5" transform="rotate(90 16.5 4.5)" stroke="white" />
            <rect opacity="0.5" x="42.5" y="4.5" width="13" height="13" rx="1.5" transform="rotate(90 42.5 4.5)" stroke="white" />
            <rect opacity="0.5" x="16.5" y="25.5" width="13" height="13" rx="1.5" transform="rotate(90 16.5 25.5)" stroke="white" />
            <rect opacity="0.5" x="42.5" y="25.5" width="13" height="13" rx="1.5" transform="rotate(90 42.5 25.5)" stroke="white" />
          </svg>
        </span>
      </div>
    </div>

    <div class="rfc-hero__content">
      <?php if (!empty($badges)): ?>
        <div class="rfc-hero__badges">
          <?php foreach ($badges as $badge): ?>
            <span class="rfc-hero__badge"><?php echo esc_html($badge['text']); ?>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 15 15">
                <path stroke="#fff" d="m14.3 4-3 3.1-.4.4.3.4 3 3-3.3 3.4-3-3-.4-.4-.4.3-3 3L.7 11l3-3 .4-.4-.4-.4-3-3L4.1.8l3 3 .4.3.3-.3 3.1-3L14.3 4Z" />
              </svg>
            </span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <h1 class="rfc-hero__title"><?php echo $title; ?></h1>
    </div>

    <div class="rfc-hero__buttons">
      <?php if ($button_text): ?>
        <a href="#shift" class="rfc-hero__button">
          <span class="rfc-hero__button-text"><?php echo esc_html($button_text); ?></span>
          <?php if ($button_subtext): ?>
            <span class="rfc-hero__button-subtext"><?php echo esc_html($button_subtext); ?></span>
          <?php endif; ?>
        </a>
      <?php endif; ?>
      <a href="#1" class="rfc-hero__next-button">
        <span class="rfc-hero__button-text">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 41 16">
            <path fill="#fff" fill-opacity=".8" d="M40.7 8.7c.4-.4.4-1 0-1.4L34.3.9A1 1 0 1 0 33 2.3L38.6 8l-5.7 5.7a1 1 0 0 0 1.4 1.4l6.4-6.4ZM0 8v1h40V7H0v1Z" />
          </svg>
        </span>
      </a>
    </div>

    <?php if (!empty($badges)): ?>
      <div class="rfc-hero__badges-mobile">
        <?php foreach ($badges as $badge): ?>
          <span class="rfc-hero__badge"><?php echo esc_html($badge['text']); ?>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 15 15">
              <path stroke="#fff" d="m14.3 4-3 3.1-.4.4.3.4 3 3-3.3 3.4-3-3-.4-.4-.4.3-3 3L.7 11l3-3 .4-.4-.4-.4-3-3L4.1.8l3 3 .4.3.3-.3 3.1-3L14.3 4Z" />
            </svg>
          </span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>