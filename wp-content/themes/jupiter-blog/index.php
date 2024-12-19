<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header();
?>
<div class="bg-square-right"></div><!-- /.bg-square-right -->
<div class="site-content" id="content">
	<?php
		get_template_part( 'template-parts/home/home', 'slider' );

		if( get_theme_mod( "jupiter_blog_show_block_section", 1 ) ) {
			get_template_part( 'template-parts/home/home', 'block' );
		}
		
		if( get_theme_mod( "jupiter_blog_show_4_col_section", 1 ) ) {
			get_template_part( 'template-parts/home/home', 'four-cols' );
		}
		
		if( get_theme_mod( "jupiter_blog_show_loop_section", 1 ) ) {
			get_template_part( 'template-parts/home/home', 'loop' );
		}
	?>
   <!-- .site-content -->
</div>

<?php
get_footer();
