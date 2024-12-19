<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header();
?>

<div class="site-content">
	<div class="fpc-blog-loop">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<header class="page-header">
						<?php
							the_archive_title( '<h1 class="fpc-single-title-one" id="content">', '</h1>' );
						?>
					</header><!-- .page-header -->
					<!-- /.col-md-12 -->
				</div>
				<div class="col-md-8">
					<?php if ( have_posts() ) : ?>
						<?php
						// Start the Loop.
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that
							 * will be used instead.
							 */
							get_template_part( 'template-parts/content/content', 'excerpt' );

							// End the loop.
						endwhile;

						// If no content, include the "No posts found" template.
					else :
						get_template_part( 'template-parts/content/content', 'none' );

					endif;

					get_template_part( 'template-parts/pagination/pagination' );
					?>
					<!-- /.col-md-8 -->
				</div>
				<div class="col-md-4">
					<?php get_sidebar(); ?>
					<!-- /.col-md-4 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container -->
		</div>
		<!-- /.fpc-blog-loop -->
	</div>
    <!-- /.site-content -->
</div>
<?php
get_footer();