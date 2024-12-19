<?php

/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

/* Theme Setup */
if (!function_exists('jupiter_blog_setup')) :

	function jupiter_blog_setup() {
		/**
		 * Adds theme support for featured image
		 */
		add_theme_support('post-thumbnails');

		/* Image Ratio - 400x300 */
		add_image_size('jupiter-blog-img-4x3', 700, 525, true);

		/* Image Ratio - 520x520 */
		add_image_size('jupiter-blog-img-1x1', 520, 520, true);

		/* Image Ratio - 300x200 */
		add_image_size('jupiter-blog-img-3x2', 700, 466, true);

		/* Image Ratio - 270x300 */
		add_image_size('jupiter-blog-img-27x30', 700, 777, true);

		/* Image Ratio - 270x340 */
		add_image_size('jupiter-blog-img-27x34', 700, 880, true);

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');
		/*
		 * Adds theme support for automatically adding document title by WordPress
		 */
		add_theme_support('title-tag');
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain('jupiter-blog');
		/**
		 * Adds custom background support.
		 */
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
			)
		);

		/**
		 * Register Navigation Menu
		 */
		register_nav_menus(array(
			'header_menu' => esc_html__('Header Menu', 'jupiter-blog'),
			'social_menu' => esc_html__('Social Menu', 'jupiter-blog')
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 55,
				'width'       => 220,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		*/
		add_editor_style(array('assets/css/editor-style.css', jupiter_blog_fonts_url()));
	}

endif;

add_action('after_setup_theme', 'jupiter_blog_setup');
