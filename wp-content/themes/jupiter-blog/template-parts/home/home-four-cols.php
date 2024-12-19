<?php
$jupiter_blog_category_filter      = get_theme_mod("jupiter_blog_4_col_categories_setting", "");

if (!empty($jupiter_blog_category_filter)) {
	if ($jupiter_blog_category_filter[0] == '0') {
		$jupiter_blog_category_filter = "";
	}
}

$jupiter_blog_list_args = array(
	'post_type'         =>  'post',
	'posts_per_page'	=> 	4,
	'order'             =>  'DESC',
	'ignore_sticky_posts' => 1,
	'orderby'           =>  'date',
	'category__in'      =>  $jupiter_blog_category_filter
);

$jupiter_blog_list_item  = new WP_Query($jupiter_blog_list_args);

$jupiter_blog_section_title  = get_theme_mod("jupiter_blog_show_4_col_section_title", "");
$jupiter_blog_section_desc   = get_theme_mod("jupiter_blog_show_4_col_section_desc", "");
?>

<?php if ($jupiter_blog_section_title != "" || $jupiter_blog_section_desc != "") : ?>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="section-headline mt-28">
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

<div class="container fpc-four-cols">
	<div class="row">
		<?php if ($jupiter_blog_list_item->have_posts()) :
			while ($jupiter_blog_list_item->have_posts()) : $jupiter_blog_list_item->the_post();

		?>

				<div class="col-md-3">
					<div class="fpc-block-container">
						<?php if (has_post_thumbnail()) : ?>

							<div class="fpc-img">
								<div>
									<figure><a href="<?php the_permalink(); ?>" alt="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail("jupiter-blog-img-3x2"); ?></a></figure>
								</div>
								<!-- /.fpc-img -->
							</div>
						<?php endif; ?>

						<div class="fpc-excerpt">
							<div class="fpc-cats">
								<?php jupiter_blog_the_category_colors(); ?>
								<!-- /.fpc-cats -->
							</div>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
					<!-- /.col-md-3 -->
				</div>
		<?php
			endwhile;
		endif;

		wp_reset_postdata();
		?>

		<!-- /.row -->
	</div>
	<!-- /.container.fpc-four-cols -->
</div>