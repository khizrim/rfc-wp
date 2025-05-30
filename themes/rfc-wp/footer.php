<footer class="footer">
  <div class="footer__container">
    <div class="footer__social mobile-menu__social">
      <p class="mobile-menu__social-title">НАШИ СОЦ. СЕТИ</p>
      <div class="mobile-menu__social-icons">
        <span class="mobile-menu__social-icon mobile-menu__social-icon--vk">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 29 29">
            <path fill="#fff" d="M5.75 5.64c-1.46 1.46-1.46 3.8-1.46 8.5v.83c0 4.68 0 7.03 1.46 8.5 1.47 1.45 3.82 1.45 8.54 1.45h.83c4.7 0 7.06 0 8.54-1.45 1.46-1.47 1.46-3.81 1.46-8.5v-.83c0-4.69 0-7.03-1.46-8.5-1.47-1.45-3.83-1.45-8.54-1.45h-.83c-4.71 0-7.07 0-8.54 1.45ZM7.8 10.5h2.39c.08 3.95 1.83 5.62 3.21 5.97V10.5h2.25v3.4c1.37-.14 2.8-1.7 3.3-3.4h2.23a6.57 6.57 0 0 1-3.04 4.3 6.85 6.85 0 0 1 3.56 4.32h-2.46a4.28 4.28 0 0 0-3.6-3.08v3.08h-.27c-4.75 0-7.46-3.23-7.57-8.62Z" />
          </svg>
        </span>
        <span class="mobile-menu__social-icon mobile-menu__social-icon--telegram">

          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 29 29">
            <path fill="#fff" d="M14.63 3.04A11.55 11.55 0 0 0 3.06 14.55c0 6.36 5.18 11.52 11.57 11.52 6.39 0 11.57-5.16 11.57-11.52 0-6.35-5.18-11.51-11.57-11.51ZM20 10.87c-.17 1.82-.92 6.24-1.3 8.28-.17.86-.5 1.15-.8 1.18-.66.06-1.17-.43-1.82-.86-1.02-.67-1.6-1.08-2.58-1.73-1.15-.75-.4-1.16.25-1.83.18-.17 3.14-2.85 3.2-3.1a.23.23 0 0 0-.06-.2c-.07-.06-.16-.04-.24-.03-.1.03-1.73 1.1-4.89 3.22-.46.3-.88.47-1.25.46a8.11 8.11 0 0 1-1.8-.43c-.72-.23-1.29-.36-1.24-.76.02-.2.31-.41.85-.63 3.38-1.46 5.63-2.43 6.75-2.9 3.22-1.33 3.88-1.56 4.32-1.56.1 0 .31.02.45.14.12.1.15.22.16.31v.44Z" />
          </svg>
        </span>
      </div>
    </div>

    <div class="footer__logo">
      <img src="<?php echo get_template_directory_uri(); ?>/images/logo-full.svg" alt="<?php bloginfo('name'); ?>">
    </div>

    <div class="footer__callback">
      <button class="mobile-menu__callback-btn">ОБРАТНЫЙ ЗВОНОК</button>
    </div>
  </div>

  <nav class="footer__links" aria-label="Юридическая информация">
    <p class="footer__links-title">ДОКУМЕНТЫ ДЛЯ САЙТА</p>
    <ul class="footer__columns">
      <li>
        <ul class="footer__column">
          <li><a href="#" class="footer__link">Реквизиты компании</a></li>
          <li><a href="#" class="footer__link">Публичная оферта</a></li>
        </ul>
      </li>
      <li>
        <ul class="footer__column footer__column--right">
          <li><a href="#" class="footer__link">Пользовательское соглашение</a></li>
          <li><a href="#" class="footer__link">Политика конфиденциальности</a></li>
        </ul>
      </li>
    </ul>
  </nav>

</footer>

<div class="mentors__modal" id="mentor-modal">
  <div class="mentors__modal-overlay"></div>
  <div class="mentors__modal-wrapper">
    <!-- карточка будет вставлена сюда динамически -->
  </div>
</div>

<?php wp_footer(); ?>
</body>

</html>
