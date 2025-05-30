<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>
</head>

<body class="page">
  <!-- Header -->
  <header class="header">
    <div class="header__left">
      <button class="header__icon header__icon--call" aria-label="Позвонить">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
          <path fill="#FDFDFD" d="M17.46 18.38c-1.83 0-3.63-.4-5.4-1.2-1.79-.8-3.4-1.92-4.86-3.38a16.17 16.17 0 0 1-3.38-4.85c-.8-1.78-1.2-3.58-1.2-5.4a.89.89 0 0 1 .92-.92H7.1c.2 0 .38.06.54.2.16.14.26.3.29.5l.57 3.06c.03.23.02.43-.02.59a.92.92 0 0 1-.25.41L6.1 9.54c.3.54.64 1.06 1.04 1.56s.84.99 1.33 1.46a15.44 15.44 0 0 0 3 2.31l2.05-2.05a1.42 1.42 0 0 1 1.14-.35l3.02.61c.2.06.37.17.5.32s.2.32.2.51v3.55a.89.89 0 0 1-.92.91Z" />
        </svg>
      </button>
      <button class="header__button">ВЫБРАТЬ СМЕНУ</button>
    </div>

    <div class="header__logo">
      <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />
    </div>

    <div class="header__right">
      <button class="header__icon header__icon--menu" aria-label="Открыть меню" data-toggle-menu>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 26 26">
          <path fill="#fff" d="M4.33 6.5a1.08 1.08 0 0 1 1.09-1.08h15.16a1.08 1.08 0 1 1 0 2.16H5.42A1.08 1.08 0 0 1 4.33 6.5Zm0 6.5a1.08 1.08 0 0 1 1.09-1.08h15.16a1.08 1.08 0 0 1 0 2.16H5.42A1.08 1.08 0 0 1 4.33 13Zm1.09 5.42a1.08 1.08 0 0 0 0 2.16h15.16a1.08 1.08 0 1 0 0-2.16H5.42Z" />
        </svg>
      </button>

      <div class="header__contact">
        <div class="header__phone">
          <p class="header__status"><span class="header__icon-symbol">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
                <path fill="url(#a)" d="M6.7 2a.6.6 0 0 0-.3-.7.6.6 0 0 0-.7.1l-4 5a.6.6 0 0 0 0 .7c0 .2.3.4.5.4h3.4l-.3 2.7a.6.6 0 0 0 .3.7.6.6 0 0 0 .7-.2l4-5a.6.6 0 0 0-.2-1 .6.6 0 0 0-.3 0H6.4l.3-2.8Z" />
                <defs>
                  <linearGradient id="a" x1="10.4" x2="1.4" y1="1.2" y2="1.4" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#D53289" />
                    <stop offset="1" stop-color="#EA5234" />
                  </linearGradient>
                </defs>
              </svg>
            </span> Звоните, мы в сети!</p>
          <a href="tel:+79999999999" class="header__phone-link">+7 (999) 999-99-99</a>
        </div>
        <div class="header__social">
          <span class="header__social-icon header__social-icon--whatsapp">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="none">
              <mask id="a" width="14" height="14" x="1" y="1" maskUnits="userSpaceOnUse" style="mask-type:luminance">
                <path fill="#fff" d="M1.7 1.7h12.6v12.7H1.7V1.7Z" />
              </mask>
              <g mask="url(#a)">
                <path fill="url(#b)" d="M9.2 1.8h-.4a6 6 0 0 0-6 2.7 6 6 0 0 0-.4 6.4.9.9 0 0 1 0 .7l-.7 2.8H2a134 134 0 0 1 3.3-.7A6.3 6.3 0 1 0 9.2 1.8Zm1.7 8.8A1.8 1.8 0 0 1 9 11a6.1 6.1 0 0 1-3.5-2.5L5 7a1.7 1.7 0 0 1 .4-1.7.8.8 0 0 1 .8-.3c.2 0 .3.3.4.4 0 .3.2.6.3.8a.6.6 0 0 1-.1.9c-.3.3-.3.5 0 .8.4.7 1 1.2 1.8 1.5h.6c0-.2 0-.2.2-.3.3-.5.2-.5.8-.2l.6.3c.2 0 .5.2.5.3a1 1 0 0 1-.3 1Z" />
              </g>
              <defs>
                <linearGradient id="b" x1="14.3" x2="1.4" y1="1.7" y2="2.1" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#D53289" />
                  <stop offset="1" stop-color="#EA5234" />
                </linearGradient>
              </defs>
            </svg>
          </span>
          <span class="header__social-icon header__social-icon--telegram">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="none">
              <path fill="url(#a)" d="M8 1.4a6.7 6.7 0 1 0 0 13.4A6.7 6.7 0 0 0 8 1.4ZM11 6c0 1.1-.4 3.7-.7 4.8 0 .5-.2.7-.4.7-.4 0-.7-.2-1-.5l-1.6-1c-.6-.4-.2-.6.2-1L9.3 7a.1.1 0 0 0 0-.1h-.1a70.8 70.8 0 0 0-3.6 2c-.2 0-.7 0-1-.2-.4-.1-.8-.2-.7-.4a299.7 299.7 0 0 1 6.9-3l.2.1v.2s.1.2 0 .2Z" />
              <defs>
                <linearGradient id="a" x1="14.7" x2="1" y1="1.4" y2="1.8" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#D53289" />
                  <stop offset="1" stop-color="#EA5234" />
                </linearGradient>
              </defs>
            </svg>
          </span>
        </div>
      </div>
      <div class="header__age">12+</span>
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

    <hr class="mobile-menu__divider">
    </hr>

    <button class="mobile-menu__callback-btn">ОБРАТНЫЙ ЗВОНОК</button>

    <div class="mobile-menu__social">
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

    <hr class="mobile-menu__divider">
    </hr>

    <div class="mobile-menu__contact">
      <div class="header__phone">
        <p class="header__status"><span class="header__icon-symbol">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" fill="none">
              <path fill="url(#a)" d="M6.7 2a.6.6 0 0 0-.3-.7.6.6 0 0 0-.7.1l-4 5a.6.6 0 0 0 0 .7c0 .2.3.4.5.4h3.4l-.3 2.7a.6.6 0 0 0 .3.7.6.6 0 0 0 .7-.2l4-5a.6.6 0 0 0-.2-1 .6.6 0 0 0-.3 0H6.4l.3-2.8Z" />
              <defs>
                <linearGradient id="a" x1="10.4" x2="1.4" y1="1.2" y2="1.4" gradientUnits="userSpaceOnUse">
                  <stop stop-color="#D53289" />
                  <stop offset="1" stop-color="#EA5234" />
                </linearGradient>
              </defs>
            </svg>
          </span> Звоните, мы в сети!</p>
        <a href="tel:+79999999999" class="header__phone-link">+7 (999) 999-99-99</a>
      </div>
      <div class="header__social">
        <span class="header__social-icon header__social-icon--whatsapp">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="none">
            <mask id="a" width="14" height="14" x="1" y="1" maskUnits="userSpaceOnUse" style="mask-type:luminance">
              <path fill="#fff" d="M1.7 1.7h12.6v12.7H1.7V1.7Z" />
            </mask>
            <g mask="url(#a)">
              <path fill="url(#b)" d="M9.2 1.8h-.4a6 6 0 0 0-6 2.7 6 6 0 0 0-.4 6.4.9.9 0 0 1 0 .7l-.7 2.8H2a134 134 0 0 1 3.3-.7A6.3 6.3 0 1 0 9.2 1.8Zm1.7 8.8A1.8 1.8 0 0 1 9 11a6.1 6.1 0 0 1-3.5-2.5L5 7a1.7 1.7 0 0 1 .4-1.7.8.8 0 0 1 .8-.3c.2 0 .3.3.4.4 0 .3.2.6.3.8a.6.6 0 0 1-.1.9c-.3.3-.3.5 0 .8.4.7 1 1.2 1.8 1.5h.6c0-.2 0-.2.2-.3.3-.5.2-.5.8-.2l.6.3c.2 0 .5.2.5.3a1 1 0 0 1-.3 1Z" />
            </g>
            <defs>
              <linearGradient id="b" x1="14.3" x2="1.4" y1="1.7" y2="2.1" gradientUnits="userSpaceOnUse">
                <stop stop-color="#D53289" />
                <stop offset="1" stop-color="#EA5234" />
              </linearGradient>
            </defs>
          </svg>
        </span>
        <span class="header__social-icon header__social-icon--telegram">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" fill="none">
            <path fill="url(#a)" d="M8 1.4a6.7 6.7 0 1 0 0 13.4A6.7 6.7 0 0 0 8 1.4ZM11 6c0 1.1-.4 3.7-.7 4.8 0 .5-.2.7-.4.7-.4 0-.7-.2-1-.5l-1.6-1c-.6-.4-.2-.6.2-1L9.3 7a.1.1 0 0 0 0-.1h-.1a70.8 70.8 0 0 0-3.6 2c-.2 0-.7 0-1-.2-.4-.1-.8-.2-.7-.4a299.7 299.7 0 0 1 6.9-3l.2.1v.2s.1.2 0 .2Z" />
            <defs>
              <linearGradient id="a" x1="14.7" x2="1" y1="1.4" y2="1.8" gradientUnits="userSpaceOnUse">
                <stop stop-color="#D53289" />
                <stop offset="1" stop-color="#EA5234" />
              </linearGradient>
            </defs>
          </svg>
        </span>
      </div>
      <div class="mobile-menu__age">12+</div>
    </div>
  </nav>
