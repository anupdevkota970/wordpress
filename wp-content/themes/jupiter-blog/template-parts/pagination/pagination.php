<?php
/**
 * Pagination for blog.
 */

global $wp_query;
$jupiter_blog_rand = 89785757; // need an unlikely integer

if ( $wp_query->max_num_pages <= 1 ) {
    return;
}
?>
<div class="nav-links">
    <?php
        the_posts_pagination( array(
            'base' => str_replace( $jupiter_blog_rand, '%#%', esc_url(get_pagenum_link( $jupiter_blog_rand ) ) ),
            'format' => '?paged=%#%',
            'add_args' => false,
            'current' => max( 1, get_query_var( 'paged' ) ),
            'total' => $wp_query->max_num_pages,
            'mid_size' => 4,
            'prev_text' => __( '&#8203;', 'jupiter-blog' ),
            'next_text' => __( '&#8203;', 'jupiter-blog' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'jupiter-blog' ) . ' </span>',
        ) );
    ?>
</div>
