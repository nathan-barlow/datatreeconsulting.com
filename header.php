<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <!--Google Fonts, DM Sans-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <nav>
            <div class="header-content">
                <a class="header-link" href="<?php echo esc_url(home_url()) ?>">
                    <img
                        class="header-image-large"
                        id="custom-header"
                        src="<?php echo get_custom_header()->url; ?>"
                        height="<?php echo get_custom_header()->height; ?>"
                        width="<?php echo get_custom_header()->width; ?>"
                        alt="<?php bloginfo( 'description' ); ?>"
                    >
                    <img class="header-image-small" src="/wp-content/uploads/2023/05/logo-color.png" alt="logo icon (tree)" height="54px" width="50px">
                </a>
            </div>

            <input type="checkbox" class="nav-main-menu-toggle" id="nav-main-menu-toggle">
            <label class="nav-main-menu-toggle-icon" for="nav-main-menu-toggle">
                <span></span>
            </label>

            <div class="nav-main-drawer">
                    <!-- Main Menu -->
                    <?php
                    $nav_main_header_top = array(
                        'theme_location' => 'nav-main-header-top',
                        'container_class' => 'nav-main',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 2
                    );
                    wp_nav_menu( $nav_main_header_top );
                ?>
            </div>
        </nav>
                </header>