<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */

get_header();
?>
<div class="site-content ct-single pt-65 pb-65">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<section class="fpc-single-home-template">
					<?php jupiter_blog_the_category_colors(); ?>
					<?php the_title('<h1 class="fpc-single-title-one" id="content">', '</h1>'); ?>

					<?php
					if (have_posts()) :

						while (have_posts()) : the_post();
							if (has_post_thumbnail()) :
					?>
								<div class="fpc-single-featured-image">
									<?php the_post_thumbnail(); ?>
								</div><!-- /.image-container -->
					<?php
							endif;
						endwhile; // End of the loop.
					endif;
					?>
					<div class="fpc-post-content-container">
						<div class="fpc-single-meta-content">
							<div class="fpc-meta-left">
								<div class="fpc-single-date-holder">
									<i class="icofont-clock-time"></i>
									<span class="fpc-single-date"><?php echo get_the_date("M j, Y"); ?></span>
								</div>
								<span class="fpc-single-seperator">/</span>
								<div class="fpc-single-author-holder">
									<i class="icofont-ui-user"></i>
									<span class="fpc-single-author"><?php esc_html_e("By", "jupiter-blog"); ?>
										<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
											<?php the_author(); ?>
										</a>
									</span>
								</div>
								<!-- /.fpc-meta-left -->
							</div>
							<div class="fpc-meta-right">
								<div class="fpc-single-read-holder">
									<i class="icofont-sand-clock"></i>
									<span class="fpc-single-read"><?php jupiter_blog_post_read_time(get_the_ID()); ?></span>
								</div>
								<!-- /.fpc-meta-right -->
							</div>
						</div>
						<div class="fpc-single-content-part">

							<?php
							if (have_posts()) :

								while (have_posts()) : the_post();

									get_template_part('template-parts/content/content', 'single');

								endwhile; // End of the loop.
							else :

								get_template_part('template-parts/content/content', 'none');

							endif;
							?>
						</div>
					</div>
					<div class="fpc-single-parent-socials">
						<div class="fpc-single-socials fpc-single-socials-js">
							<p class="fpc-share-text"><?php esc_html_e("Share", "jupiter-blog"); ?></p>
							<ul class="fpc-single-social-fonts">
								<li class="fpc-fb-share"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="icofont-facebook"></i></a></li>
								<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>"><i class="icofont-twitter"></i></a></li>
								<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>"><i class="icofont-linkedin"></i></a></li>
								<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>"><i class="icofont-pinterest"></i></a></li>
								<li><a href="//api.whatsapp.com/send?text=<?php echo esc_url(the_title()); ?>%0A<?php echo esc_url(the_permalink()); ?>"><i class="icofont-whatsapp"></i></a></li>
								<li><a href="mailto:?subject=<?php echo esc_url(the_title()); ?>&body=<?php echo esc_url(the_permalink()); ?>"><i class="icofont-envelope-open"></i></a></li>
							</ul>
						</div>
						<div class="fpc-single-tags">
							<?php
							if ($jupiter_blog_tags = get_the_tags()) {
								foreach ($jupiter_blog_tags as $jupiter_blog_tags) {
									$jupiter_blog_sep = ($jupiter_blog_tags === end($jupiter_blog_tags)) ? '' : ' ';
									echo '<a href="' . esc_url(get_term_link($jupiter_blog_tags, $jupiter_blog_tags->taxonomy)) . '">#' . esc_html($jupiter_blog_tags->name) . '</a>' . esc_html($jupiter_blog_sep);
								}
							}
							?>
						</div>
					</div>
					<hr class="fpc-single-solid">
					<div class="fpc-single-author-desc">
						<div class="fpc-single-author-img">
							<?php echo get_avatar(get_the_author_meta('ID')); ?>
						</div>
						<div class="fpc-single-author-content">
							<p class="entry-author-label"><?php echo esc_html__('About the author', 'jupiter-blog') ?></p>
							<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
								<span class="fpc-single-author-name"><?php the_author(); ?>
								</span>
								<!-- /.author-name -->
							</a>
							<div class="fpc-single-author-content-desc"><?php if (get_the_author_meta('description')) : ?>
									<p><?php the_author_meta('description'); ?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<hr class="fpc-single-solid">
					<div class="fpc-single-prev-next-button">
						<?php $jupiter_blog_prev_post = get_adjacent_post(false, '', true); ?>
						<?php if (is_a($jupiter_blog_prev_post, 'WP_Post')) { ?>
							<div class="previous-post-wrap">
								<div class="previous-post">
									<a href="<?php echo esc_url(get_permalink(get_adjacent_post(false, '', true)->ID)); ?>">
										<i class="icofont-rounded-left"></i>
									</a>
								</div>
								<!-- /.previous-post -->
								<a href="<?php echo esc_url(get_permalink(get_adjacent_post(false, '', true)->ID)); ?>" class="prev"><?php echo esc_html(get_the_title($jupiter_blog_prev_post->ID)); ?></a>
							</div>
							<!-- /.previous-post-wrap -->
						<?php } ?>

						<?php $jupiter_blog_next_post = get_adjacent_post(false, '', false); ?>
						<?php if (is_a($jupiter_blog_next_post, 'WP_Post')) { ?>
							<div class="next-post-wrap">
								<div class="next-post">
									<a href="<?php echo esc_url(get_permalink(get_adjacent_post(false, '', false)->ID)); ?>">
										<i class="icofont-rounded-right"></i>
									</a>
								</div>
								<!-- /.next-post -->
								<a href="<?php echo esc_url(get_permalink(get_adjacent_post(false, '', false)->ID)); ?>" class="next"><?php echo esc_html(get_the_title($jupiter_blog_next_post->ID)); ?></a>
							</div>
							<!-- /.next-post-wrap -->
						<?php } ?>
					</div>
					<!-- fpc-single-home-template -->
				</section>

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<section class="fpc-comment-section">
							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if (comments_open() || get_comments_number()) :
								comments_template();
							endif;
							?>
						</section>
				<?php endwhile;
				endif; ?>
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
	<!-- /.site-content -->
</div>
<?php
get_footer();
