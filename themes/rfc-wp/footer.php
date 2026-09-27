<?php
$vk = get_field('vk_link', 'option');
$telegram = get_field('telegram_link', 'option');
$zen = get_field('zen_link', 'option');
$rutube = get_field('rutube_link', 'option');
$max = get_field('max_link', 'option');
$email = get_field('email', 'option');
$wa_link = rfc_get_whatsapp_link();

$footer_socials = [
  ['url' => $vk, 'icon' => 'vk.svg', 'label' => 'ВКонтакте'],
  ['url' => $telegram, 'icon' => 'tg.svg', 'label' => 'Telegram'],
  ['url' => $wa_link, 'icon' => 'wa.svg', 'label' => 'WhatsApp'],
  ['url' => $max, 'icon' => 'max.svg', 'label' => 'MAX'],
  ['url' => $zen, 'icon' => 'zen.svg', 'label' => 'Zen'],
  ['url' => $rutube, 'icon' => 'rt.svg', 'label' => 'Rutube'],
];
?>


<footer class="footer">
  <div class="footer__container">
    <div class="footer__social">
      <p class="footer__social-title">Контакты</p>
      <div class="footer__social-icons">
        <?php foreach ($footer_socials as $social): ?>
          <?php if ($social['url']): ?>
            <a href="<?php echo esc_url($social['url']); ?>" class="footer__social-icon" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($social['label']); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/images/icons/<?php echo $social['icon']; ?>" alt="<?php echo esc_attr($social['label']); ?>">
            </a>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

      <?php if ($email): ?>
        <div class="footer__social-contacts">
          <p class="footer__social-text">По любым вопросам пишите на:</p>
          <a href="mailto:<?php echo esc_attr($email); ?>" class="footer__social-link"><?php echo esc_html($email); ?></a>
        </div>
      <?php endif; ?>
    </div>

    <div class="footer__info">
      <div class="footer__logo">
        <img src="<?php echo esc_url(rfc_get_logo_url('logo_footer', 'logo-full.svg')); ?>" alt="<?php bloginfo('name'); ?>">
      </div>

      <div class="footer__callback">
        <button class="footer__callback-button open-callback-form">Обратный звонок</button>
      </div>
    </div>
  </div>

  <div class="footer__nav">
    <nav class="footer__links" aria-label="Юридическая информация">
      <?php rfc_render_footer_menu(); ?>
    </nav>

    <p class="footer__year">
      <?php echo date('Y'); ?>
    </p>
  </div>

</footer>

<div class="rfc-mentors__modal" id="mentor-modal">
  <div class="rfc-mentors__modal-overlay"></div>
  <div class="rfc-mentors__modal-wrapper">
    <!-- карточка будет вставлена сюда динамически -->
  </div>
</div>

<div class="callback-modal" id="callback-modal">
  <div class="callback-modal__overlay"></div>
  <div class="callback-modal__wrapper">
    <div class="callback-modal__content">
      <h2 class="callback-modal__title">Заказать звонок</h2>
      <p class="callback-modal__subtitle">
        Оставьте свои контакты и мы свяжемся с вами в ближайшее время!
      </p>
      <div class="callback-modal__form">
        <?php echo do_shortcode('[contact-form-7 id="4507756" title="Форма обратного звонка"]'); ?>
      </div>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>

</html>