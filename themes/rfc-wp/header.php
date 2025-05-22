<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>
</head>

<body class="body">

  <header class="header">
    <div class="header__container container">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" />
      </a>
    </div>
  </header>