<?php
/**
 * Template part for displaying Single Post content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-content clearfix">
        <?php
            the_content(
                sprintf(
                    /* translators: %s: Name of current post */
                    __( '<span class="screen-reader-text"> "%s"</span>', 'jupiter-blog' ),
                    get_the_title()
                )
            );

            wp_link_pages(
                array(
                    'before'      => '<div class="link-pages-wrap clearfix"><div class="link-pages">' . esc_html__( 'Continue Reading:', 'jupiter-blog' ),
                    'after'       => '</div></div>',
                    'link_before' => '<span class="page-numbers button">',
                    'link_after'  => '</span>',
                )
            );
        ?>
    </div><!-- /.post-content -->
</div>