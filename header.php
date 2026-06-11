<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Doma Holding Company — Building Tomorrow's Legacy</title>
  <meta name="description" content="Doma Holding — A diversified group delivering excellence in real estate, infrastructure, technology and investment."/>
  <?php wp_head(); ?>




</head>
<body>

<div class="noise-overlay"></div>
<button class="back-to-top" id="backToTop"><i class="fas fa-chevron-up"></i></button>
<div class="mobile-nav-overlay" id="mobileNavOverlay"></div>

<!-- MOBILE NAV -->
<!-- MOBILE NAV -->
<aside class="mobile-nav-panel" id="mobileNavPanel">

    <button class="mobile-nav-close" id="mobileNavClose">
        <i class="fas fa-times"></i>
    </button>

    <nav class="mobile-nav-links">

        <?php
        wp_nav_menu(array(
            'theme_location' => 'mobile_menu',
            'container'      => false,
            'menu_class'     => 'mobile-menu',
            'fallback_cb'    => false,
            'items_wrap'     => '%3$s'
        ));
        ?>

    </nav>

    <div style="margin-top:32px;">
        <a href="<?php echo esc_url(home_url('/contact')); ?>"
           class="btn-gold"
           style="display:flex;justify-content:center;">
            <i class="fas fa-paper-plane"></i>
            &nbsp;Get In Touch
        </a>
    </div>

</aside>

<!-- ═══ NAVBAR ═══ -->


<header class="doma-nav" id="domaNav">
    <div class="container">
        <div class="nav-inner">

            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">

                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/doma.png"
                         alt="<?php bloginfo('name'); ?>"
                         class="img-fluid">
                <?php } ?>

            </a>

            <!-- Desktop Menu -->
            <nav class="nav-links">

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary_menu',
                    'container'      => false,
                    'menu_class'     => 'desktop-menu',
                    'fallback_cb'    => false,
                    'items_wrap'     => '%3$s'
                ));
                ?>

            </nav>

            <!-- CTA Button -->
            <a href="<?php echo esc_url(home_url('/contact')); ?>"
               class="btn-gold nav-cta">
                <i class="fas fa-paper-plane"></i>
                Get In Touch
            </a>

            <!-- Mobile Toggle -->
            <button class="nav-toggle" id="navToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</header>