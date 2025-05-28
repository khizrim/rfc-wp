<?php

/**
 * RFC Hero block
 */

$image = get_field('background_image');
$badges = get_field('badges');
$title = get_field('title');
$button_text = get_field('button_text');
$button_subtext = get_field('button_subtext');
$button_url = get_field('button_url');
?>

<section class="rfc-hero" style="background-image: url('<?php echo esc_url($image['url']); ?>');">
  <div class="rfc-hero__badges">
    <?php foreach ($badges as $badge): ?>
      <span class="rfc-hero__badge"><?php echo esc_html($badge['text']); ?></span>
    <?php endforeach; ?>
  </div>

  <h1 class="rfc-hero__title"><?php echo $title; ?></h1>

  <a href="<?php echo esc_url($button_url); ?>" class="rfc-hero__button">
    <span class="rfc-hero__button-text"><?php echo esc_html($button_text); ?></span>
    <span class="rfc-hero__button-subtext"><?php echo esc_html($button_subtext); ?></span>
  </a>
</section>
