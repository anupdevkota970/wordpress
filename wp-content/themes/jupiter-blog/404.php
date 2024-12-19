<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * 
 * @package WordPress
 * @subpackage Jupiter Blog
 * @since Jupiter Blog 1.0
 */

get_header(); ?>
	
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					<header class="page-header">
						<h1 class="page-title"><?php _e( '404', 'jupiter-blog' ); ?></h1>
					</header>

					<div class="page-wrapper">
						<div class="page-content">
							<h2><?php _e( 'Page Not Found', 'jupiter-blog' ); ?></h2>
							<p><?php _e( 'We\'re sorry , the page you resquested could not be found. Please go back to the homepage.', 'jupiter-blog' ); ?></p>
							<?php get_search_form(); ?>
						</div><!-- .page-content -->
					</div><!-- .page-wrapper -->

				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- /.col-md-8 offset-md-2 -->
	</div><!-- /.row -->
</div><!-- /.container -->

<?php get_footer(); ?>