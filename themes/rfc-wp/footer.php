<?php
$vk = get_field('vk_link', 'option');
$telegram = get_field('telegram_link', 'option');
$zen = get_field('zen_link', 'option');
$rutube = get_field('rutube_link', 'option');
?>


<footer class="footer">
  <div class="footer__container">
    <div class="footer__social">a
      <p class="footer__social-title">Контакты</p>
      <div class="footer__social-icons">
        <a href="<?php echo esc_url($vk); ?>" class="footer__social-icon" target="_blank" rel="noopener noreferrer" aria-label="ВКонтакте">
          <img src="<?php echo get_template_directory_uri(); ?>/images/icons/vk.svg" alt="ВКонтакте">
        </a>
        <a href="<?php echo esc_url($telegram); ?>" class="footer__social-icon" target="_blank" rel="noopener noreferrer" aria-label="Telegram">
          <img src="<?php echo get_template_directory_uri(); ?>/images/icons/tg.svg" alt="Telegram">
        </a>
        <a href="<?php echo esc_url($zen); ?>" class="footer__social-icon" target="_blank" rel="noopener noreferrer" aria-label="Zen">
          <img src="<?php echo get_template_directory_uri(); ?>/images/icons/zen.svg" alt="Zen">
        </a>
        <a href="<?php echo esc_url($rutube); ?>" class="footer__social-icon" target="_blank" rel="noopener noreferrer" aria-label="Rutube">
          <img src="<?php echo get_template_directory_uri(); ?>/images/icons/rt.svg" alt="Rutube">
        </a>
      </div>

      <div class="footer__social-contacts">
        <p class="footer__social-text">По любым вопросам пишите на:</p>
        <a href="mailto:<?php echo get_field('email', 'option'); ?>" class="footer__social-link"><?php echo get_field('email', 'option'); ?></a>
      </div>
    </div>

    <div class="footer__info">
      <div class="footer__logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo-full.svg" alt="<?php bloginfo('name'); ?>">
      </div>

      <div class="footer__callback">
        <button class="footer__callback-button">Обратный звонок</button>
      </div>
    </div>
  </div>

  <div class="footer__nav">
    <nav class="footer__links" aria-label="Юридическая информация">
      <ul class="footer__column">
        <li><a href="#" class="footer__link">Реквизиты компании</a></li>
        <li><a href="#" class="footer__link">Публичная оферта</a></li>
        <li><a href="#" class="footer__link">Пользовательское соглашение</a></li>
        <li><a href="#" class="footer__link">Политика конфиденциальности</a></li>
      </ul>
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

<?php wp_footer(); ?>
</body>

</html>