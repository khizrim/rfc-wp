<?php

$cf7_shortcode = get_field('trial-form') ?: '[contact-form-7 id="08b1275" title="Форма пробного периода"]';
$title = get_field('trial_title') ?: 'Попробуй бесплатно!';
$subtitle = get_field('trial_subtitle')
  ?: 'Оставь заявку и попробуй бесплатное занятие в нашей школе и ощути атмосферу лагеря!';
?>

<div class="rfc-trial-form">
    <h2 class="rfc-trial-form__title"><?php echo esc_html($title); ?></h2>
    <p class="rfc-trial-form__subtitle"><?php echo esc_html($subtitle); ?></p>
    <hr class="rfc-trial-form__divider"></hr>
    <div class="rfc-trial-form__form">
        <?php echo do_shortcode($cf7_shortcode); ?>
    </div>
    <hr class="rfc-trial-form__divider"></hr>
</div>
