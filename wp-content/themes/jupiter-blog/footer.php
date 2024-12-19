<?php if (
	is_active_sidebar('jupiter-blog-footer-left') ||
	is_active_sidebar('jupiter-blog-footer-middle') ||
	is_active_sidebar('jupiter-blog-footer-right')
) : ?>
	<footer class="fpc-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<?php
					if (is_active_sidebar('jupiter-blog-footer-left')) {
						dynamic_sidebar('jupiter-blog-footer-left');
					}
					?>
				</div>
				<div class="col-md-4">
					<?php
					if (is_active_sidebar('jupiter-blog-footer-middle')) {
						dynamic_sidebar('jupiter-blog-footer-middle');
					}
					?>
				</div>
				<div class="col-md-4">
					<?php
					if (is_active_sidebar('jupiter-blog-footer-right')) {
						dynamic_sidebar('jupiter-blog-footer-right');
					}
					?>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</div>
	</footer>
<?php endif; ?>

<!-- Sticky header -->
<div id="fpc-sticky-header" class="sticky-header js-sticky-header">
	<!-- Navigation bar -->
	<nav class="navigation-bar navigation-bar--fullwidth  hidden-xs hidden-sm">
		<div class="container ">
			<div class="navigation-bar__inner">
				<?php get_template_part('template-parts/header/site', 'branding'); ?>
				<div class="navigation-wrapper navigation-bar__section js-priority-nav">
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
				</div>
				<?php if (get_theme_mod('jupiter_blog_menu_search_setting', 1)) : ?>
					<div class="navigation-bar__section">
						<button type="submit" class="navigation-bar-btn js-search-dropdown-toggle"><i class="icofont-search"></i></button>
					</div>
				<?php endif; ?>
			</div>
			<!-- .navigation-bar__inner -->
		</div>
		<!-- .container -->
	</nav>
	<!-- Navigation bar -->
</div>
<!-- Sticky header -->

<!-- Off-canvas menu -->
<div id="fpc-offcanvas-primary" class="fpc-offcanvas js-fpc-offcanvas js-perfect-scrollbar">
	<div class="fpc-offcanvas__title">
		<?php get_template_part('template-parts/header/site', 'branding'); ?>
	</div>
	<div class="fpc-offcanvas__section fpc-offcanvas__section-navigation">

		<?php
		if (has_nav_menu('header_menu')) {
			wp_nav_menu(
				array(
					'theme_location'    => 'header_menu',
					'container'         => 'li',
					'menu_id'           => 'menu-offcanvas-menu',
					'menu_class'        => 'navigation navigation--offcanvas',
					'depth'             => 3,
					'walker'            => new Jupiter_Blog_Dropdown_Toggle_Walker_Nav_Menu(),
					'fallback_cb'       => '',
				)
			);
		}
		?>
	</div>
	<a href="#fpc-offcanvas-primary" class="fpc-offcanvas-close js-fpc-offcanvas-close" aria-label="Close"><span aria-hidden="true">&#10005;</span></a>
</div>
<!-- Off-canvas menu -->

<a href="#" class="fpc-go-top btn btn-default hidden-xs js-go-top-el">
	<span class="icofont-long-arrow-up fpc-top"></span>
</a>
<div id="search-full" class="fpc-search-full">
	<form action="#action" method="get">
		<input name="s" id="search-popup" class="form-control" placeholder="<?php esc_attr_e("Enter your keywords", 'jupiter-blog') ?>" type="text" value="">
		<span id="fpc-search-remove"><a href="#" class="js-search-kn"><i class="icofont-close"></i></a></span>
	</form>
</div>

<div class="container">
	<div class="footer-site-info">
		<p><?php esc_html_e('Copyright', 'jupiter-blog'); ?> <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a><?php esc_html_e('. All rights reserved.', 'jupiter-blog'); ?>
			<span class="footer-info-right">
				<?php echo esc_html__(' | Designed by', 'jupiter-blog') ?> <a href="<?php echo esc_url('https://www.crafthemes.com/', 'jupiter-blog'); ?>"><?php echo esc_html__(' Crafthemes', 'jupiter-blog') ?></a>
			</span>
		</p>
	</div><!-- /.footer-site-info -->
</div>
</div>
<!-- .site-wrapper -->
<?php wp_footer(); ?>
</body>

</html>