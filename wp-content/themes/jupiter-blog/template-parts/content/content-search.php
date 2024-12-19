<div class="fpc-sbs">
    <?php if (has_post_thumbnail()) : ?>
        <div class="fpc-img">
            <figure>
                <a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail("jupiter-blog-img-4x3"); ?>
                </a>
            </figure>
            <!-- /.fpc-img -->
        </div>
    <?php endif; ?>

    <div class="fpc-excerpt">
        <div class="fpc-cats">
            <?php jupiter_blog_the_category_colors(); ?>
            <!-- /.fpc-cats -->
        </div>
        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <p class="ct-excerpt"><?php jupiter_blog_excerpt(35); ?></p>
        <div class="fpc-excerpt-meta">
            <span class="fpc-author">
                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
            </span>
            <a href="<?php the_permalink(); ?>"><span class="fpc-post-date"><?php echo get_the_date("M j, Y"); ?></span></a>
            <!-- /.fpc-excerpt-meta -->
        </div>
        <!-- /.fpc-excerpt -->
    </div>
</div><!-- /.fpc-sbs -->