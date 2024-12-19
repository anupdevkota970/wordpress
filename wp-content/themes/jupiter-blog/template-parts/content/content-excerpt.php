<?php

/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="fpc-sbs">
		<div class="fpc-img">
			<figure>
				<a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail("jupiter-blog-img-4x3"); ?>
				</a>
			</figure>
			<!-- /.fpc-img -->
		</div>
		<div class="fpc-excerpt">
			<div class="fpc-cats">
				<?php jupiter_blog_the_category_colors(); ?>
				<!-- /.fpc-cats -->
			</div>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
					<p class="fpc-date-tag"><?php echo get_comments_number() ?> <?php echo esc_html('', 'jupiter-blog'); ?></p>
				</div>
				<!-- /.fpc-excerpt-meta -->
			</div>
			<!-- /.fpc-excerpt -->
		</div>
		<!-- /.fpc-sbs -->
	</div>
</div>