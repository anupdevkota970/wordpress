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

/***************************************************************************************************
 * Enqueue all CSS and JS
 ***************************************************************************************************/

if (!function_exists('jupiter_blog_enqueue_cs_js')) :

    function jupiter_blog_enqueue_cs_js() {

        $jupiter_blog_primary_color  = esc_attr(get_theme_mod('jupiter_blog_primary_color_setting'));
        $jupiter_blog_bg_sec_color  = esc_attr(get_theme_mod('jupiter_blog_bg_sec_setting'));
        $jupiter_blog_sp_header_color  = esc_attr(get_theme_mod('jupiter_blog_sp_header_color_setting'));
        $jupiter_blog_custom_css     = "a:hover, .footer-site-info a, .fpc-footer .widget_recent_entries *:hover, ul.slick-dots li.slick-active button::before, ul.slick-dots li button::before, .widget_recent_entries li > a:hover,
    .navigation--main-menu.navigation--main > li > a:hover, .navigation--main-menu.navigation--main .sub-menu li:hover > a {
        color: {$jupiter_blog_primary_color};
    }

    .site-wrapper input[type=search],
    .site-wrapper input[type=text],
    .site-wrapper input[type=number],
    .site-wrapper input[type=password],
    .site-wrapper input[type=email],
    #comments #comment,
    #comments input,
    .mc4wp-form-fields input[type=email] {
        border-top: 2px solid {$jupiter_blog_primary_color} !important;
    }

    .site-wrapper input[type=submit],
    .site-wrapper .button-general,
    .site-wrapper .widget_search button[type=submit],
    #comments .form-submit #submit,
    .pagination span.page-numbers,
    .post-page-numbers span.page-numbers,
    .pagination .current,
    .post-page-numbers .current,
    .pagination .page-numbers:hover,
    .post-page-numbers .page-numbers:hover {
        background-color: {$jupiter_blog_primary_color};
        box-shadow: rgba(255, 117, 101, 0.25) 1px 5px 3px -2px, {$jupiter_blog_primary_color} 0px 4px 7px -4px;
    }

    .fpc-single-author-desc .fpc-single-author-content p.entry-author-label {
        background-image: linear-gradient(180deg, transparent 90%, {$jupiter_blog_primary_color} 0);
    }

    .fpc-underline {
        background-image: linear-gradient(180deg, transparent 90%, {$jupiter_blog_primary_color} 0);
    }

    .fpc-go-top {
        background-color: {$jupiter_blog_primary_color};
    }
    
    .fpc-go-top:focus {
        background-color: {$jupiter_blog_primary_color};
    }
    
    .bg-square-right,
    .bg-square {
        background-color: {$jupiter_blog_bg_sec_color};
    }
    
    .single .site-header, .page .site-header, .error404 .site-header, .author .site-header, .archive .site-header, .search .site-header {
        background-color: {$jupiter_blog_sp_header_color};
    }";

        $theme          = wp_get_theme();
        $theme_version  = $theme->get('Version');

        wp_enqueue_style('jupiter-blog-gfonts', jupiter_blog_fonts_url(), array(), '1.0.0');
        wp_enqueue_style('jupiter-blog-icofont', get_template_directory_uri() . '/assets/css/icofont.min.css', array(), $theme_version, 'all');
        wp_enqueue_style('jupiter-blog-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), $theme_version, 'all');
        wp_enqueue_style('jupiter-blog-slick', get_template_directory_uri() . '/assets/css/slick.css', array(), $theme_version, 'all');
        wp_enqueue_style('jupiter-blog-slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', array(), $theme_version, 'all');
        wp_enqueue_style('jupiter-blog-style-css', get_template_directory_uri() . '/style.css', array(), $theme_version, 'all');

        if (!empty($jupiter_blog_primary_color) || !empty($jupiter_blog_bg_sec_color) || !empty($jupiter_blog_sp_header_color)) {
            wp_add_inline_style('jupiter-blog-style-css', $jupiter_blog_custom_css);
        }

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        wp_enqueue_script('jupiter-blog-jquery-slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), $theme_version, true);
        wp_enqueue_script('jupiter-blog-jquery-vendors', get_template_directory_uri() . '/assets/js/vendors.min.js', array('jquery'), $theme_version, true);
        wp_enqueue_script('jupiter-blog-jquery-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), $theme_version, true);
    }

endif;

add_action('wp_enqueue_scripts', 'jupiter_blog_enqueue_cs_js');

// Enqueue Admin Scripts
if (!function_exists('jupiter_blog_admin_scripts')) :
    function jupiter_blog_admin_scripts() {
        // For categories
        if (null !== ($screen = get_current_screen()) && 'edit-category' !== $screen->id) {
            return;
        }
        wp_enqueue_media();
        wp_enqueue_script('jupiter-blog-jquery-admin-script', get_template_directory_uri() . '/assets/js/jquery-admin.js', array('jquery'), '', true);
    }
endif;

add_action('admin_enqueue_scripts', 'jupiter_blog_admin_scripts');

// Enqueue Admin Scripts
if (!function_exists('jupiter_blog_welcome_scripts')) :
    function jupiter_blog_welcome_scripts() {
        if (isset($_GET['page']) && $_GET['page'] === 'theme-info.php') {
            wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/assets/css/admin-css.css');
        }
    }
endif;
add_action('admin_enqueue_scripts', 'jupiter_blog_welcome_scripts');
