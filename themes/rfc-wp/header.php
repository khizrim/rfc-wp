<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>
</head>

<?php
$phone = get_field('phone_number', 'option');
$vk = get_field('vk_link', 'option');
$telegram = get_field('telegram_link', 'option');
?>


<body class="page">
  <!-- Header -->
  <header class="header">
    <div class="header__left">
      <div class="header__age">12+</span>
      </div>
      <a href="tel:<?php echo preg_replace('/\D+/', '', $phone); ?>" class="header__icon header__icon--call" aria-label="Позвонить">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
          <path fill="#FDFDFD" d="M17.46 18.38c-1.83 0-3.63-.4-5.4-1.2-1.79-.8-3.4-1.92-4.86-3.38a16.17 16.17 0 0 1-3.38-4.85c-.8-1.78-1.2-3.58-1.2-5.4a.89.89 0 0 1 .92-.92H7.1c.2 0 .38.06.54.2.16.14.26.3.29.5l.57 3.06c.03.23.02.43-.02.59a.92.92 0 0 1-.25.41L6.1 9.54c.3.54.64 1.06 1.04 1.56s.84.99 1.33 1.46a15.44 15.44 0 0 0 3 2.31l2.05-2.05a1.42 1.42 0 0 1 1.14-.35l3.02.61c.2.06.37.17.5.32s.2.32.2.51v3.55a.89.89 0 0 1-.92.91Z" />
        </svg>
      </a>
      <a href="#shift" class="header__button">Выбрать смену</a>
    </div>

    <div class="header__logo">
      <a href="<?php echo home_url('/'); ?>" aria-label="Главная страница">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />
      </a>
    </div>

    <div class="header__right">
      <button class="header__icon header__icon--menu" aria-label="Открыть меню" data-toggle-menu>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 26 26">
          <path fill="#fff" d="M4.33 6.5a1.08 1.08 0 0 1 1.09-1.08h15.16a1.08 1.08 0 1 1 0 2.16H5.42A1.08 1.08 0 0 1 4.33 6.5Zm0 6.5a1.08 1.08 0 0 1 1.09-1.08h15.16a1.08 1.08 0 0 1 0 2.16H5.42A1.08 1.08 0 0 1 4.33 13Zm1.09 5.42a1.08 1.08 0 0 0 0 2.16h15.16a1.08 1.08 0 1 0 0-2.16H5.42Z" />
        </svg>
      </button>
      <div class="header__contact">
        <div class="header__social">
          <?php if ($telegram): ?>
            <a href="<?php echo esc_url($telegram); ?>" class="header__social-icon header__social-icon--telegram" target="_blank" aria-label="Telegram">
              <svg width="48" height="48" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_123_250)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24ZM24.8601 17.7179C22.5257 18.6888 17.8603 20.6984 10.8638 23.7466C9.72766 24.1984 9.13251 24.6404 9.07834 25.0726C8.98677 25.803 9.90142 26.0906 11.1469 26.4822C11.3164 26.5355 11.4919 26.5907 11.6719 26.6492C12.8973 27.0475 14.5457 27.5135 15.4026 27.5321C16.1799 27.5489 17.0475 27.2284 18.0053 26.5707C24.5423 22.158 27.9168 19.9276 28.1286 19.8795C28.2781 19.8456 28.4852 19.803 28.6255 19.9277C28.7659 20.0524 28.7521 20.2886 28.7372 20.352C28.6466 20.7383 25.0562 24.0762 23.1982 25.8036C22.619 26.3421 22.2081 26.724 22.1242 26.8113C21.936 27.0067 21.7443 27.1915 21.56 27.3692C20.4215 28.4667 19.5678 29.2896 21.6072 30.6336C22.5873 31.2794 23.3715 31.8135 24.1539 32.3463C25.0084 32.9282 25.8606 33.5085 26.9632 34.2313C27.2442 34.4155 27.5125 34.6068 27.7738 34.7931C28.7681 35.5019 29.6615 36.1388 30.7652 36.0373C31.4065 35.9782 32.0689 35.3752 32.4053 33.5767C33.2004 29.3263 34.7633 20.1169 35.1244 16.3219C35.1561 15.9895 35.1163 15.5639 35.0843 15.3771C35.0523 15.1904 34.9855 14.9242 34.7427 14.7272C34.4552 14.4939 34.0113 14.4447 33.8127 14.4482C32.91 14.4641 31.5251 14.9456 24.8601 17.7179Z" fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_123_250">
                    <rect width="48" height="48" fill="currentColor" />
                  </clipPath>
                </defs>
              </svg>
            </a>
          <?php endif; ?>
          <a href="https://wa.me/<?php echo preg_replace('/\D+/', '', $phone); ?>" class="header__social-icon header__social-icon--whatsapp" target="_blank" aria-label="WhatsApp">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 48L3.374 35.674C1.292 32.066 0.198 27.976 0.2 23.782C0.206 10.67 10.876 0 23.986 0C30.348 0.002 36.32 2.48 40.812 6.976C45.302 11.472 47.774 17.448 47.772 23.804C47.766 36.918 37.096 47.588 23.986 47.588C20.006 47.586 16.084 46.588 12.61 44.692L0 48ZM13.194 40.386C16.546 42.376 19.746 43.568 23.978 43.57C34.874 43.57 43.75 34.702 43.756 23.8C43.76 12.876 34.926 4.02 23.994 4.016C13.09 4.016 4.22 12.884 4.216 23.784C4.214 28.234 5.518 31.566 7.708 35.052L5.71 42.348L13.194 40.386ZM35.968 29.458C35.82 29.21 35.424 29.062 34.828 28.764C34.234 28.466 31.312 27.028 30.766 26.83C30.222 26.632 29.826 26.532 29.428 27.128C29.032 27.722 27.892 29.062 27.546 29.458C27.2 29.854 26.852 29.904 26.258 29.606C25.664 29.308 23.748 28.682 21.478 26.656C19.712 25.08 18.518 23.134 18.172 22.538C17.826 21.944 18.136 21.622 18.432 21.326C18.7 21.06 19.026 20.632 19.324 20.284C19.626 19.94 19.724 19.692 19.924 19.294C20.122 18.898 20.024 18.55 19.874 18.252C19.724 17.956 18.536 15.03 18.042 13.84C17.558 12.682 17.068 12.838 16.704 12.82L15.564 12.8C15.168 12.8 14.524 12.948 13.98 13.544C13.436 14.14 11.9 15.576 11.9 18.502C11.9 21.428 14.03 24.254 14.326 24.65C14.624 25.046 18.516 31.05 24.478 33.624C25.896 34.236 27.004 34.602 27.866 34.876C29.29 35.328 30.586 35.264 31.61 35.112C32.752 34.942 35.126 33.674 35.622 32.286C36.118 30.896 36.118 29.706 35.968 29.458Z" fill="currentColor" />
            </svg>
          </a>
        </div>
        <div class="header__phone">
          <p class="header__status">Звоните, мы в сети!</p>
          <a href="tel:<?php echo preg_replace('/\D+/', '', $phone); ?>" class="header__phone-link"><?php echo esc_html($phone); ?></a>
        </div>
      </div>
    </div>
  </header>

  <!-- Desktop Navigation Bar -->
  <nav class="nav-bar">
    <div class="nav-bar__container">
      <ul class="nav-bar__list">
        <?php
        // Get all blocks from the current page
        $blocks = parse_blocks(get_the_content());

        // Filter for section heading blocks and create menu items
        foreach ($blocks as $block) {
          if ($block['blockName'] === 'acf/rfc-section-heading') {
            $heading = $block['attrs']['data']['heading-text'] ?? '';
            $id = $block['attrs']['data']['heading-id'] ?? '';

            if ($heading && $id) {
              echo '<li class="nav-bar__item"><a href="#' . esc_attr($id) . '" class="nav-bar__link">' . wp_strip_all_tags($heading) . '</a></li>';
            }
          }
        }
        ?>
      </ul>
    </div>
  </nav>

  <nav class="mobile-menu" data-mobile-menu>
    <ul class="mobile-menu__list">
      <li class="mobile-menu__item"><a href="/" class="mobile-menu__link">Главная</a></li>
      <?php
      // Get all blocks from the current page
      $blocks = parse_blocks(get_the_content());

      // Filter for section heading blocks and create menu items
      foreach ($blocks as $block) {
        if ($block['blockName'] === 'acf/rfc-section-heading') {
          $heading = $block['attrs']['data']['heading-text'] ?? '';
          $id = $block['attrs']['data']['heading-id'] ?? '';

          if ($heading && $id) {
            echo '<li class="mobile-menu__item"><a href="#' . esc_attr($id) . '" class="mobile-menu__link">' . wp_strip_all_tags($heading) . '</a></li>';
          }
        }
      }
      ?>
    </ul>

    <div class="mobile-menu__bottom">
      <div class="mobile-menu__contact">
        <div class="mobile-menu__age">12+</div>
        <button class="mobile-menu__callback-btn open-callback-form">Обратный звонок</button>
      </div>

      <div class="mobile-menu__social">
        <div class="mobile-menu__social-icons">
          <?php if ($telegram): ?>
            <a href="<?php echo esc_url($telegram); ?>" class="header__social-icon header__social-icon--telegram" target="_blank" aria-label="Telegram">
              <svg width="48" height="48" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_123_250)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M48 24C48 37.2548 37.2548 48 24 48C10.7452 48 0 37.2548 0 24C0 10.7452 10.7452 0 24 0C37.2548 0 48 10.7452 48 24ZM24.8601 17.7179C22.5257 18.6888 17.8603 20.6984 10.8638 23.7466C9.72766 24.1984 9.13251 24.6404 9.07834 25.0726C8.98677 25.803 9.90142 26.0906 11.1469 26.4822C11.3164 26.5355 11.4919 26.5907 11.6719 26.6492C12.8973 27.0475 14.5457 27.5135 15.4026 27.5321C16.1799 27.5489 17.0475 27.2284 18.0053 26.5707C24.5423 22.158 27.9168 19.9276 28.1286 19.8795C28.2781 19.8456 28.4852 19.803 28.6255 19.9277C28.7659 20.0524 28.7521 20.2886 28.7372 20.352C28.6466 20.7383 25.0562 24.0762 23.1982 25.8036C22.619 26.3421 22.2081 26.724 22.1242 26.8113C21.936 27.0067 21.7443 27.1915 21.56 27.3692C20.4215 28.4667 19.5678 29.2896 21.6072 30.6336C22.5873 31.2794 23.3715 31.8135 24.1539 32.3463C25.0084 32.9282 25.8606 33.5085 26.9632 34.2313C27.2442 34.4155 27.5125 34.6068 27.7738 34.7931C28.7681 35.5019 29.6615 36.1388 30.7652 36.0373C31.4065 35.9782 32.0689 35.3752 32.4053 33.5767C33.2004 29.3263 34.7633 20.1169 35.1244 16.3219C35.1561 15.9895 35.1163 15.5639 35.0843 15.3771C35.0523 15.1904 34.9855 14.9242 34.7427 14.7272C34.4552 14.4939 34.0113 14.4447 33.8127 14.4482C32.91 14.4641 31.5251 14.9456 24.8601 17.7179Z" fill="currentColor" />
                </g>
                <defs>
                  <clipPath id="clip0_123_250">
                    <rect width="48" height="48" fill="currentColor" />
                  </clipPath>
                </defs>
              </svg>
            </a>
          <?php endif; ?>
          <a href="https://wa.me/<?php echo preg_replace('/\D+/', '', $phone); ?>" class="header__social-icon header__social-icon--whatsapp" target="_blank" aria-label="WhatsApp">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 48L3.374 35.674C1.292 32.066 0.198 27.976 0.2 23.782C0.206 10.67 10.876 0 23.986 0C30.348 0.002 36.32 2.48 40.812 6.976C45.302 11.472 47.774 17.448 47.772 23.804C47.766 36.918 37.096 47.588 23.986 47.588C20.006 47.586 16.084 46.588 12.61 44.692L0 48ZM13.194 40.386C16.546 42.376 19.746 43.568 23.978 43.57C34.874 43.57 43.75 34.702 43.756 23.8C43.76 12.876 34.926 4.02 23.994 4.016C13.09 4.016 4.22 12.884 4.216 23.784C4.214 28.234 5.518 31.566 7.708 35.052L5.71 42.348L13.194 40.386ZM35.968 29.458C35.82 29.21 35.424 29.062 34.828 28.764C34.234 28.466 31.312 27.028 30.766 26.83C30.222 26.632 29.826 26.532 29.428 27.128C29.032 27.722 27.892 29.062 27.546 29.458C27.2 29.854 26.852 29.904 26.258 29.606C25.664 29.308 23.748 28.682 21.478 26.656C19.712 25.08 18.518 23.134 18.172 22.538C17.826 21.944 18.136 21.622 18.432 21.326C18.7 21.06 19.026 20.632 19.324 20.284C19.626 19.94 19.724 19.692 19.924 19.294C20.122 18.898 20.024 18.55 19.874 18.252C19.724 17.956 18.536 15.03 18.042 13.84C17.558 12.682 17.068 12.838 16.704 12.82L15.564 12.8C15.168 12.8 14.524 12.948 13.98 13.544C13.436 14.14 11.9 15.576 11.9 18.502C11.9 21.428 14.03 24.254 14.326 24.65C14.624 25.046 18.516 31.05 24.478 33.624C25.896 34.236 27.004 34.602 27.866 34.876C29.29 35.328 30.586 35.264 31.61 35.112C32.752 34.942 35.126 33.674 35.622 32.286C36.118 30.896 36.118 29.706 35.968 29.458Z" fill="currentColor" />
            </svg>
          </a>
        </div>

        <div class="mobile-menu__contact">
          <div class="header__phone">
            <p class="header__status"><span class="header__icon-symbol">
              </span> Звоните, мы в сети!</p>
            <a href="tel:<?php echo preg_replace('/\D+/', '', $phone); ?>" class="header__phone-link"><?php echo esc_html($phone); ?></a>
          </div>
          <div class="header__social">
            <a href="https://wa.me/<?php echo preg_replace('/\D+/', '', $phone); ?>" class="header__social-icon header__social-icon--whatsapp" target="_blank" aria-label="WhatsApp">
              <img src="<?php echo get_template_directory_uri(); ?>/images/icons/whatsapp-social.svg" alt="WhatsApp" width="16" height="16" />
            </a>
            <?php if ($telegram): ?>
              <a href="<?php echo esc_url($telegram); ?>" class="header__social-icon header__social-icon--telegram" target="_blank" aria-label="Telegram">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/telegram-social.svg" alt="Telegram" width="16" height="16" />
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>


    </div>
  </nav>