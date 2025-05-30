<?php
$heading = get_field('heading-text');
$subheading = get_field('heading-subtext') ?: '';
$position = get_field('heading-position') ?: 'left';
$with_line = get_field('heading-line');

$class = 'section-heading section-heading--' . esc_attr($position);
if ($with_line) {
  $class .= ' with-line';
}
?>

<section class="<?= $class ?>">
  <?php if ($with_line): ?>
    <div class="section-heading__line"></div>
  <?php endif; ?>

  <div class="section-heading__content">
    <h2 class="section-heading__text"><?= $heading ?></h2>
    <?php if ($subheading): ?>
      <p class="section-heading__subtext"><?= $subheading ?></p>
    <?php endif; ?>
  </div>
</section>
