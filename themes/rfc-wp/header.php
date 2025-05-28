<header class="header">
  <div class="header__left">
    <button class="header__icon header__icon--call" aria-label="Позвонить"></button>
    <button class="header__icon header__icon--menu" aria-label="Открыть меню" data-toggle-menu></button>
  </div>

  <div class="header__logo">
    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />
  </div>

  <div class="header__right">
    <div class="header__button">
      <button class="header__select-shift">ВЫБРАТЬ СМЕНУ</button>
    </div>
    <div class="header__contact">
      <p class="header__status"><span class="header__icon-symbol">⚡</span> Звоните, мы в сети!</p>
      <a href="tel:+79999999999" class="header__phone">+7 (999) 999-99-99</a>
      <div class="header__social">
        <span class="header__social-icon header__social-icon--whatsapp"></span>
        <span class="header__social-icon header__social-icon--telegram"></span>
        <span class="header__age">12+</span>
      </div>
    </div>
  </div>
</header>

<nav class="mobile-menu" data-mobile-menu>
  <ul class="mobile-menu__list">
    <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Главная</a></li>
    <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Что делаем в лагере?</a></li>
    <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Наши работы</a></li>
    <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Наши наставники</a></li>
    <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Как это было</a></li>
    <li class="mobile-menu__item"><a href="#" class="mobile-menu__link">Безопасность в лагере</a></li>
  </ul>

  <button class="mobile-menu__callback-btn">ОБРАТНЫЙ ЗВОНОК</button>

  <div class="mobile-menu__social">
    <p class="mobile-menu__social-title">НАШИ СОЦ. СЕТИ</p>
    <div class="mobile-menu__social-icons">
      <span class="mobile-menu__social-icon mobile-menu__social-icon--vk"></span>
      <span class="mobile-menu__social-icon mobile-menu__social-icon--telegram"></span>
    </div>
  </div>

  <div class="mobile-menu__contact">
    <p class="mobile-menu__status"><span class="mobile-menu__icon">⚡</span> Звоните, мы в сети!</p>
    <a href="tel:+79999999999" class="mobile-menu__phone">+7 (999) 999-99-99</a>
    <span class="mobile-menu__age">12+</span>
  </div>
</nav>
