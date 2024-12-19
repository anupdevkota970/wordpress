<?php

/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything upto navigation menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>
<!DOCTYPE html>
<html>

<head <?php language_attributes(); ?>>
	<!-- Basic -->
	<meta charset="<?php bloginfo('charset'); ?>" />
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php wp_head(); ?>
</head>

<body <?php body_class('home'); ?>>
	<?php
	if (function_exists('wp_body_open')) {
		wp_body_open();
	}
	?>
	<a class="skip-link" href="#content">
		<?php esc_html_e('Skip to content', 'jupiter-blog'); ?></a>

	<!-- Site wrapper -->
	<div class="site-wrapper ">
		<!-- Site header -->
		<header class="site-header">
			<!-- Mobile header -->
			<div class="container">
				<div class="row">
					<div id="fpc-mobile-header" class="fpc-mobile-header visible-xs visible-sm">
						<div class="mobile-header__inner mobile-header__inner--flex">
							<div class="header-branding flexbox__item header-branding--mobile mobile-header__section flexbox text-left">
								<div class="button-head">
									<a href="#fpc-offcanvas-primary" class="offcanvas-menu-toggle mobile-header-btn js-fpc-offcanvas-toggle">
										<div class="button-head"></div>
									</a>
								</div>
								<div class=" flexbox__item text-left">
									<?php get_template_part('template-parts/header/site', 'branding'); ?>
								</div>
							</div>
							<div class="navigation-bar__section everly-sticky">
								<?php
								if (has_nav_menu('social_menu')) {
									wp_nav_menu(
										array(
											'theme_location'    => 'social_menu',
											'container'         => 'li',
											'menu_id'           => '',
											'menu_class'        => 'social-list social-list--md list-horizontal',
											'link_before'       => '<span class="screen-reader-text">',
											'link_after'        => '</span>',
											'depth'             => 1,
											'fallback_cb'       => '',
										)
									);
								}
								?>
								<!-- /.navigation-bar__section.everly-sticky -->
							</div>

							<?php if (get_theme_mod('jupiter_blog_menu_search_setting', 1)) : ?>
								<div class="navigation-bar__section">
									<button type="submit" class="navigation-bar-btn js-search-dropdown-toggle"><i class="icofont-search"></i></button>
									<!-- /.navigation-bar__section -->
								</div>
							<?php endif; ?>

							<!-- /.mobile-header__inner.mobile-header__inner--flex -->
						</div>
						<!-- /#fpc-mobile-header.fpc-mobile-header.visible-xs.visible-sm -->
					</div>
					<!-- Mobile header -->
					<!-- Navigation bar -->
					<nav class="navigation-bar navigation-bar--fullwidth hidden-xs hidden-sm js-sticky-header-holder">
						<div class="container">
							<div class="navigation-bar__inner">
								<?php get_template_part('template-parts/header/site', 'branding'); ?>
								<div class="navigation-wrapper navigation-bar__section js-priority-nav text-left">
									<?php
									if (has_nav_menu('header_menu')) {
										wp_nav_menu(
											array(
												'theme_location'    => 'header_menu',
												'container'         => 'li',
												'menu_id'           => 'menu-main-menu-1',
												'menu_class'        => 'navigation navigation--main navigation--inline navigation--main-menu',
												'depth'             => 3,
												'fallback_cb'       => '',
											)
										);
									}
									?>
								</div>
								<div class="navigation-bar__section everly-sticky">
									<?php
									if (has_nav_menu('social_menu')) {
										wp_nav_menu(
											array(
												'theme_location'    => 'social_menu',
												'container'         => 'li',
												'menu_id'           => '',
												'menu_class'        => 'social-list social-list--md list-horizontal',
												'link_before'       => '<span class="screen-reader-text">',
												'link_after'        => '</span>',
												'depth'             => 1,
												'fallback_cb'       => '',
											)
										);
									}
									?>
									<!-- /.navigation-bar__section.everly-sticky -->
								</div>

								<?php if (get_theme_mod('jupiter_blog_menu_search_setting', 1)) : ?>
									<div class="navigation-bar__section">
										<button type="submit" class="navigation-bar-btn js-search-dropdown-toggle"><i class="icofont-search"></i></button>
										<!-- /.navigation-bar__section -->
									</div>
								<?php endif; ?>
								<!-- /.navigation-bar__inner -->
							</div>
							<!-- /.container -->
						</div>
					</nav>
					<!-- Navigation bar -->
				</div>
				<!-- /.container -->
			</div>
			<!-- /.site-header -->
		</header>
		<!-- Site header -->