<?php

/**
 * RFC Mentors block
 */

$mentor_ids = get_field('mentors');
if (!$mentor_ids) return;
?>

<section class="rfc-mentors">
  <div class="rfc-mentors__track">
    <?php foreach ($mentor_ids as $post_id): ?>
      <?php
      $name = get_the_title($post_id);
      $photo = get_field('photo', $post_id);
      $fact1 = get_field('fact_1', $post_id);
      $fact2 = get_field('fact_2', $post_id);
      $description = get_field('description', $post_id);
      $telegram = get_field('telegram', $post_id);
      $whatsapp = get_field('whatsapp', $post_id);
      $instagram = get_field('instagram', $post_id);
      $logo = get_field('logo', $post_id);
      ?>
      <div class="rfc-mentor">
        <?php if ($logo): ?>
          <img class="rfc-mentor__logo" src="<?php echo esc_url($logo['url']); ?>" alt="RFC Logo">
        <?php endif; ?>
        <div class="rfc-mentor__photo" style="background-image: url('<?php echo esc_url($photo['url']); ?>');"></div>
        <h3 class="rfc-mentor__name"><?php echo esc_html($name); ?></h3>
        <div class="rfc-mentor__facts">
          <?php if ($fact1): ?><span><?php echo esc_html($fact1); ?></span><?php endif; ?>
          <?php if ($fact2): ?><span><?php echo esc_html($fact2); ?></span><?php endif; ?>
        </div>
        <button class="rfc-mentor__more">Узнать больше</button>
        <div class="rfc-mentor__modal">
          <p><?php echo esc_html($description); ?></p>
          <div class="rfc-mentor__socials">
            <?php if ($telegram): ?><a href="<?php echo esc_url($telegram); ?>" target="_blank">TG</a><?php endif; ?>
            <?php if ($whatsapp): ?><a href="<?php echo esc_url($whatsapp); ?>" target="_blank">WA</a><?php endif; ?>
            <?php if ($instagram): ?><a href="<?php echo esc_url($instagram); ?>" target="_blank">IG</a><?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>
