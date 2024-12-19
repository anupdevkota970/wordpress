<?php
$jupiter_blog_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$jupiter_blog_list_args = array(
	'post_type'         =>  'post',
	'posts_per_page'	=> 	4,
	'order'             =>  'DESC',
	'paged' 			=> $jupiter_blog_paged,
	'ignore_sticky_posts' => 1,
);

$jupiter_blog_list_item  = new WP_Query($jupiter_blog_list_args);
?>
<div class="fpc-blog-loop">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php if ($jupiter_blog_list_item->have_posts()) :
					while ($jupiter_blog_list_item->have_posts()) : $jupiter_blog_list_item->the_post();
				?>
						<div class="fpc-sbs">
							<div class="fpc-img">
								<div>
									<figure><a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail("jupiter-blog-img-4x3"); ?>
										</a></figure>
								</div>
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
										<p class="fpc-date-tag"><?php echo get_comments_number() ?></p>
									</div>
									<!-- /.fpc-excerpt-meta -->
								</div>
								<!-- /.fpc-excerpt -->
							</div>
							<!-- /.fpc-sbs -->
						</div>
					<?php
					endwhile;
					?>
					<div class="pagination">
						<?php
						jupiter_blog_number_pagination();
						?>
					</div>
				<?php
				endif;

				wp_reset_postdata();
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