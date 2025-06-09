<?php
$heading = get_field('heading-text');
$subheading = get_field('heading-subtext') ?: '';
$position = get_field('heading-position') ?: 'left';
$with_line = get_field('heading-line');
$id = get_field('heading-id') ?: '';

$class = 'rfc-section-heading rfc-section-heading--' . esc_attr($position);
if ($with_line) {
  $class .= ' with-line';
}
?>

<section class="<?= $class ?>" id="<?= esc_attr($id) ?>">

  <div class="rfc-section-heading__content">
    <div class="rfc-section-heading__inner">
      <?php if ($with_line): ?>
        <div class="rfc-section-heading__line"></div>
      <?php endif; ?>
      <h2 class="rfc-section-heading__text"><?= $heading ?></h2>
    </div>


    <?php if ($subheading): ?>
      <p class="rfc-section-heading__subtext"><?= $subheading ?></p>
    <?php endif; ?>
  </div>
</section>