<?php
/**
 * Displays header site branding
 *
 */

?>
<div class="navigation-bar__section">
	<div class="header-branding header-branding--mobile mobile-header__section text-left">
		<div class="header-logo header-logo--mobile flexbox__item text-left">
			<?php
		        if ( has_custom_logo() ) {
		            if ( function_exists( 'the_custom_logo' ) ) {
		                the_custom_logo();
		            }
		        } else {
		    ?>
		        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		    <?php
		        }
		    ?>
		</div>
	</div>
</div>