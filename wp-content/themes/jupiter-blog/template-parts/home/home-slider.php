<?php

/**
 * Template part for displaying Slider section in homepage
 */

$jupiter_blog_args = array(
    'post_type'         =>  'post',
    'posts_per_page'    =>  3,
);
$jupiter_blog_item  = new WP_Query($jupiter_blog_args);
?>

<div class="fpc-slider-area pt-65 pb-65">
    <div class="container">
        <div class="row fpc-slider">
            <?php
            if ($jupiter_blog_item->have_posts()) :
                while ($jupiter_blog_item->have_posts()) : $jupiter_blog_item->the_post();
            ?>
                    <div class="fpc-slide">
                        <div class="fpc-slide-area">
                            <div class="col-md-6">
                                <div class="fpc-cats">
                                    <?php jupiter_blog_the_category_colors(); ?>
                                    <!-- /.fpc-cats -->
                                </div>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="ct-excerpt"><?php jupiter_blog_excerpt(35); ?></p>
                                <div class="fpc-excerpt-meta">
                                    <span class="fpc-author">
                                        <span class="icofont-ui-user"></span>
                                        <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                                    </span>
                                    <div class="fpc-date">
                                        <span class="icofont-clock-time"></span>
                                        <p class="fpc-date-tag"><?php echo get_the_date("M j, Y"); ?></p>
                                    </div>
                                    <div class="fpc-comm">
                                        <span class="icofont-speech-comments"></span>
                                        <p class="fpc-date-tag"><?php echo get_comments_number() ?></p>
                                    </div>
                                    <!-- /.fpc-excerpt-meta -->
                                </div>
                                <!-- /.fpc-excerpt -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="fpc-img">
                                        <div>
                                            <figure>
                                                <a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
                                                    <?php the_post_thumbnail("jupiter-blog-img-1x1"); ?>
                                                </a>
                                            </figure>
                                        </div>
                                        <!-- /.fpc-img -->
                                    </div>
                                <?php endif; ?>
                            </div><!-- /.col-md-6 -->
                        </div><!-- /.fpc-slide-content -->
                    </div><!-- /.fpc-slide -->
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div><!-- /.row -->
    </div><!-- /.container -->

    <div class="fpc-slider-arrows">
        <div class="fpc-prev">
            <i class="icofont-rounded-left"></i>
        </div> <!-- /.fpc-prev -->
        <div class="fpc-next">
            <i class="icofont-rounded-right"></i>
        </div> <!-- /.fpc-next -->
    </div><!-- /.fpc-slider-arrows -->

</div><!-- /.fpc-slider-area -->