<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();
?>
<div class="site-content ct-page pt-65 pb-65">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<section class="fpc-single-home-template">
					<?php jupiter_blog_the_category_colors(); ?>
					<?php the_title( '<h1 class="fpc-single-title-one">', '</h1>' ); ?>

					<?php
					    if ( have_posts() ) :

					        while ( have_posts() ) : the_post();
					             if ( has_post_thumbnail() ):
					    ?>
					                <div class="fpc-single-featured-image">
					                    <?php the_post_thumbnail(); ?>
					                </div><!-- /.image-container -->
					    <?php
					            endif;
					        endwhile; // End of the loop.
					    endif;
					?>
	                <div class="fpc-single-content-part">
	                	
	                    <?php
			                if ( have_posts() ) :

			                    while ( have_posts() ) : the_post();

			                        get_template_part( 'template-parts/content/content', 'single' );

			                    // If comments are open or we have at least one comment, load up the comment template.
			                    if ( comments_open() || get_comments_number() ) :
			                        comments_template();
			                    endif;

			                    endwhile; // End of the loop.
			                else :

			                    get_template_part( 'template-parts/content/content', 'none' );

			                endif;
			            ?>
	                </div>
	                <!-- fpc-single-home-template -->
	            </section>
				<!-- /.col-md-8 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container -->
	</div>
    <!-- /.site-content -->
</div>
<?php
get_footer();