<?php

$cf7_shortcode = get_field('trial-form') ?: '[contact-form-7 id="08b1275" title="Форма пробного периода"]';
?>

<div class="rfc-trial-form">
    <h2 class="rfc-trial-form__title">Попробуй бесплатно!</h2>
    <p class="rfc-trial-form__subtitle">Оставь заявку и попробуй бесплатное занятие в нашей школе и ощути атмосферу лагеря!</p>
    <hr class="rfc-trial-form__divider"></hr>
    <div class="rfc-trial-form__form">
        <?php echo do_shortcode($cf7_shortcode); ?>
    </div>
    <hr class="rfc-trial-form__divider"></hr>
</div>
