<?php

/**
 * Template part for displaying the widgets and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jupiter Blog
 * @subpackage Jupiter Blog
 * @since Jupiter Blog 1.0
 */

function jupiter_blog_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'jupiter-blog'),
        'id'            => 'jupiter-blog-main-sidebar',
        'description'   => esc_html__('Add widgets here to appear in your single post sidebar area.', 'jupiter-blog'),
        'before_widget' => '<div id="%1$s" class="%2$s sidebar-widgetarea widgetarea">',
        'after_widget'  => '</div><!-- /.sidebar-widgetarea -->',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Left', 'jupiter-blog'),
        'id'            => 'jupiter-blog-footer-left',
        'description'   => esc_html__('Add widgets here to appear on your left footer section.', 'jupiter-blog'),
        'before_widget' => '<div id="%1$s" class="%2$s widgetarea">',
        'after_widget'  => '</div><!-- /.widgetarea -->',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Middle', 'jupiter-blog'),
        'id'            => 'jupiter-blog-footer-middle',
        'description'   => esc_html__('Add widgets here to appear on your middle footer section.', 'jupiter-blog'),
        'before_widget' => '<div id="%1$s" class="%2$s widgetarea">',
        'after_widget'  => '</div><!-- /.widgetarea -->',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Right', 'jupiter-blog'),
        'id'            => 'jupiter-blog-footer-right',
        'description'   => esc_html__('Add widgets here to appear on your right footer section.', 'jupiter-blog'),
        'before_widget' => '<div id="%1$s" class="%2$s widgetarea">',
        'after_widget'  => '</div><!-- /.widgetarea -->',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}


add_action('widgets_init', 'jupiter_blog_widgets_init');
