<?php
$jupiter_blog_category_filter      = get_theme_mod("jupiter_blog_block_categories_setting", "");

if (!empty($jupiter_blog_category_filter)) {
    if ($jupiter_blog_category_filter[0] == '0') {
        $jupiter_blog_category_filter = "";
    }
}

$jupiter_blog_list_args = array(
    'post_type'         =>  'post',
    'posts_per_page'    =>      2,
    'order'             =>  'DESC',
    'orderby'           =>  'date',
    'category__in'      =>  $jupiter_blog_category_filter
);

$jupiter_blog_list_item  = new WP_Query($jupiter_blog_list_args);

$jupiter_blog_list_args_second = array(
    'post_type'         =>  'post',
    'posts_per_page'    =>      3,
    'order'             =>  'DESC',
    'orderby'           =>  'date',
    'offset'            =>      2,
    'ignore_sticky_posts' => 1,
    'category__in'      => $jupiter_blog_category_filter
);

$jupiter_blog_list_item_second  = new WP_Query($jupiter_blog_list_args_second);

$jupiter_blog_list_args_third = array(
    'post_type'         =>  'post',
    'posts_per_page'    =>      3,
    'order'             =>  'DESC',
    'orderby'           =>  'date',
    'offset'            =>      5,
    'ignore_sticky_posts' => 1,
    'category__in'      => $jupiter_blog_category_filter
);

$jupiter_blog_list_item_third  = new WP_Query($jupiter_blog_list_args_third);

$jupiter_blog_section_title  = get_theme_mod("jupiter_blog_show_block_section_title", "");
$jupiter_blog_section_desc   = get_theme_mod("jupiter_blog_show_block_section_desc", "");
?>
<div class="section-block-area pt-65 pb-65">
    <div class="bg-square"></div><!-- /.bg-square -->
    <?php if ($jupiter_blog_section_title != "" || $jupiter_blog_section_desc != "") : ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="section-headline">
                        <?php if ($jupiter_blog_section_title != "") : ?>
                            <h2><?php echo ($jupiter_blog_section_title); ?></h2>
                        <?php endif; ?>

                        <?php if ($jupiter_blog_section_desc != "") : ?>
                            <p><?php echo ($jupiter_blog_section_desc); ?></p>
                        <?php endif; ?>
                    </div><!-- /.section-headline -->
                </div><!-- /.col-md-8 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                if ($jupiter_blog_list_item->have_posts()) :
                    while ($jupiter_blog_list_item->have_posts()) : $jupiter_blog_list_item->the_post();
                ?>

                        <div class="fpc-block-container">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="fpc-img">
                                    <div>
                                        <figure>
                                            <a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
                                                <?php the_post_thumbnail("jupiter-blog-img-3x2"); ?>
                                            </a>
                                        </figure>
                                    </div>
                                    <!-- /.fpc-img -->
                                </div>
                            <?php endif; ?>

                            <div class="fpc-excerpt">
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
                            </div>
                            <!-- /.fpc-block-container -->
                        </div>
                <?php
                    endwhile;
                else :
                    get_template_part('template-parts/post/content', 'none');
                endif;

                wp_reset_postdata();
                ?>
                <!-- /.col-md-6 -->
            </div>
            <div class="col-md-3">
                <?php
                $jupiter_blog_counter = 0;
                if ($jupiter_blog_list_item_second->have_posts()) :
                    while ($jupiter_blog_list_item_second->have_posts()) : $jupiter_blog_list_item_second->the_post();
                ?>
                        <div class="fpc-block-container">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="fpc-img">
                                    <div>
                                        <figure>
                                            <a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
                                                <?php
                                                if ($jupiter_blog_counter == 0) {
                                                    the_post_thumbnail("jupiter-blog-img-27x30");
                                                } else {
                                                    the_post_thumbnail("jupiter-blog-img-3x2");
                                                }

                                                $jupiter_blog_counter++;
                                                ?>
                                            </a>
                                        </figure>
                                    </div>
                                    <!-- /.fpc-img -->
                                </div>
                            <?php endif; ?>

                            <div class="fpc-excerpt">
                                <div class="fpc-cats">
                                    <?php jupiter_blog_the_category_colors(); ?>
                                    <!-- /.fpc-cats -->
                                </div>
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
                            </div>
                            <!-- /.fpc-block-container -->
                        </div>
                <?php
                    endwhile;
                else :
                    get_template_part('template-parts/post/content', 'none');
                endif;

                wp_reset_postdata();
                ?>
                <!-- /.col-md-3 -->
            </div>
            <div class="col-md-3">
                <?php
                $jupiter_blog_counter = 0;
                if ($jupiter_blog_list_item_third->have_posts()) :
                    while ($jupiter_blog_list_item_third->have_posts()) : $jupiter_blog_list_item_third->the_post();
                ?>
                        <div class="fpc-block-container">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="fpc-img">
                                    <div>
                                        <figure>
                                            <a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
                                                <?php
                                                if ($jupiter_blog_counter == 1) {
                                                    the_post_thumbnail("jupiter-blog-img-27x34");
                                                } else {
                                                    the_post_thumbnail("jupiter-blog-img-27x18");
                                                }

                                                $jupiter_blog_counter++;
                                                ?>
                                            </a>
                                        </figure>
                                    </div>
                                    <!-- /.fpc-img -->
                                </div>
                            <?php endif; ?>

                            <div class="fpc-excerpt">
                                <div class="fpc-cats">
                                    <?php jupiter_blog_the_category_colors(); ?>
                                    <!-- /.fpc-cats -->
                                </div>
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
                            </div>
                            <!-- /.fpc-block-container -->
                        </div>
                <?php
                    endwhile;
                else :
                    get_template_part('template-parts/post/content', 'none');
                endif;

                wp_reset_postdata();
                ?>
                <!-- /.col-md-3 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
</div><!-- /.section-block-area -->