<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 */

get_header();

if ( have_posts() ) :
?>
<div class="container search-result-headline pt-65">
    <div class="row">
        <div class="col-md-12">
            <h1><?php esc_html_e( 'Search results for: ', 'jupiter-blog' ); ?><?php echo get_search_query(); ?></h1>
        </div>
    </div> <!-- /.row -->
</div> <!-- /.container -->
<?php endif; ?>

<div class="container search-result-body pt-65 pb-65">
    <div class="row grid">
        <div class="col-md-8">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content/content', 'search' );

                    endwhile; // End of the loop.
                else :

                        get_template_part( 'template-parts/content/content', 'none' );

                endif;
            ?>
        </div><!-- .col-md-8 -->

        <div class="col-md-4">
                <?php get_sidebar(); ?>
        </div><!-- /.col-md-4 -->
    </div><!-- /.row -->
</div><!-- /.container -->
<?php
    // Pagination
    get_template_part( 'template-parts/pagination/pagination', get_post_format() );

get_footer();
