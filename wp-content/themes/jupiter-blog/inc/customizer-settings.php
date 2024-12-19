<?php
// Same as free version
function jupiter_blog_section_setup( $wp_customize ) {
        /**
         * Colors Section
        */

        /* Bg Secondary Color*/
        $wp_customize->add_setting( 'jupiter_blog_bg_sec_setting', array(
            'default'   => '#fff5ef',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'jupiter_blog_bg_sec_control', array(
            'section' => 'colors',
            'label'   => esc_html__( 'Background Secondary color', 'jupiter-blog' ),
            'settings'      =>  'jupiter_blog_bg_sec_setting',
        ) ) );

        /* Primary Color*/
        $wp_customize->add_setting( 'jupiter_blog_primary_color_setting', array(
            'default'   => '#ff7565',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

       $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'jupiter_blog_primary_color_control', array(
         'section' => 'colors',
         'label'   => esc_html__( 'Primary color', 'jupiter-blog' ),
         'settings'      =>  'jupiter_blog_primary_color_setting',
       ) ) );
       
       /* Single Page Header Color*/
        $wp_customize->add_setting( 'jupiter_blog_sp_header_color_setting', array(
            'default'   => '#fff5ef',
            'sanitize_callback' => 'sanitize_hex_color',
        ) );

       $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'jupiter_blog_sp_header_color_control', array(
         'section' => 'colors',
         'label'   => esc_html__( 'Single page header color', 'jupiter-blog' ),
         'settings'      =>  'jupiter_blog_sp_header_color_setting',
       ) ) );

        // Category color select
        $wp_customize->add_setting( 'jupiter_blog_edit_category_setting', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        ) );

        $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jupiter_blog_edit_category_control', array(
            /* translators: %1$s: Widget Link Start, %2$s: Link End, %3$s: Nav Menu Link */
            'description'     => sprintf( __( 'Goto %1$sCategories%2$s and edit each category to change the category text color!', 'jupiter-blog' ), '<a href="' . esc_attr( admin_url() ) . 'edit-tags.php?taxonomy=category">', '</a>' ),
            'section'         => 'colors',
            'settings'        => 'jupiter_blog_edit_category_setting',
            'type'            => 'hidden',
        ) ) );

    /**
	 * Customizer Homepage -> Homepage Contents
	*/
	$wp_customize->add_section( 'jupiter_blog_homepage_sections' , array(
		'title'      => __( 'Homepage Sections', 'jupiter-blog' ),
		'priority'   => 50,
	) );

    // Enable Homepage Block Section?
	$wp_customize->add_setting('jupiter_blog_show_block_section', array(
		'default'    => 1,
        'sanitize_callback' => 'absint',
	));
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jupiter_blog_show_block_section',
            array(
                'label'     => __('Enable Block Section', 'jupiter-blog'),
                'section'   => 'jupiter_blog_homepage_sections',
                'settings'  => 'jupiter_blog_show_block_section',
                'type'      => 'checkbox',
            )
        )
    );

	// Homepage Block Section Title
	$wp_customize->add_setting( 'jupiter_blog_show_block_section_title', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'jupiter_blog_show_block_section_title',
			array(
				'label'    => __( 'Section Title', 'jupiter-blog' ),
				'section'  => 'jupiter_blog_homepage_sections',
				'settings' => 'jupiter_blog_show_block_section_title',
				'type'     => 'text',
                'active_callback' => 'jupiter_blog_is_block_section_enabled'
			)
		)
	);

    // Homepage Block Section Description
    $wp_customize->add_setting( 'jupiter_blog_show_block_section_desc', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'jupiter_blog_show_block_section_desc',
			array(
				'label'    => __( 'Section Description', 'jupiter-blog' ),
				'section'  => 'jupiter_blog_homepage_sections',
				'settings' => 'jupiter_blog_show_block_section_desc',
				'type'     => 'text',
                'active_callback' => 'jupiter_blog_is_block_section_enabled'
			)
		)
	);

    // Block Section Select Categories
    $wp_customize->add_setting( 'jupiter_blog_block_categories_setting', array(
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'jupiter_blog_project_types_sanitize'
    ) );

    $wp_customize->add_control(
        new Jupiter_Blog__Customize_Control_Multiple_Select(
            $wp_customize,
            'jupiter_blog_block_categories_control',
            array(
                'settings' => 'jupiter_blog_block_categories_setting',
                'label'    => __( 'Select Post Categories', 'jupiter-blog' ),
                'section'  => 'jupiter_blog_homepage_sections', // Enter the name of your own section
                'type'     => 'multiple-select', // The $type in our class
                'choices'  => jupiter_blog_project_types(), // Your choices
                'active_callback' => 'jupiter_blog_is_block_section_enabled'
            )
        )
    );

    // Info: Hidden
    $wp_customize->add_setting( 'jupiter_blog_category_description_setting', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jupiter_blog_category_description_control', array(
        /* translators: %1$s: Widget Link Start, %2$s: Link End, %3$s: Nav Menu Link */
        'description'     => __( "You can select multiple categories by pressing Ctrl + Click ( Windows ) or Command + Click ( Mac )", "jupiter-blog" ),
        'section'         => 'jupiter_blog_homepage_sections',
        'settings'        => 'jupiter_blog_category_description_setting',
        'type'            => 'hidden',
        'active_callback' => 'jupiter_blog_is_block_section_enabled'
    ) ) );
    
    // Enable Four Column Section?
	$wp_customize->add_setting('jupiter_blog_show_4_col_section', array(
		'default'    => 1,
        'sanitize_callback' => 'absint',
	));
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jupiter_blog_show_4_col_section',
            array(
                'label'     => __('Enable Four Columns Section', 'jupiter-blog'),
                'section'   => 'jupiter_blog_homepage_sections',
                'settings'  => 'jupiter_blog_show_4_col_section',
                'type'      => 'checkbox',
            )
        )
    );

	// Homepage Four Column Section Title
	$wp_customize->add_setting( 'jupiter_blog_show_4_col_section_title', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'jupiter_blog_show_4_col_section_title',
			array(
				'label'    => __( 'Section Title', 'jupiter-blog' ),
				'section'  => 'jupiter_blog_homepage_sections',
				'settings' => 'jupiter_blog_show_4_col_section_title',
				'type'     => 'text',
                'active_callback' => 'jupiter_blog_is_4_col_section_enabled'
			)
		)
	);

    // Homepage Four Column Section Description
    $wp_customize->add_setting( 'jupiter_blog_show_4_col_section_desc', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'jupiter_blog_show_4_col_section_desc',
			array(
				'label'    => __( 'Section Description', 'jupiter-blog' ),
				'section'  => 'jupiter_blog_homepage_sections',
				'settings' => 'jupiter_blog_show_4_col_section_desc',
				'type'     => 'text',
                'active_callback' => 'jupiter_blog_is_4_col_section_enabled'
			)
		)
	);

    // Four Columns Section Select Categories
    $wp_customize->add_setting( 'jupiter_blog_4_col_categories_setting', array(
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'jupiter_blog_project_types_sanitize'
    ) );

    $wp_customize->add_control(
        new Jupiter_Blog__Customize_Control_Multiple_Select(
            $wp_customize,
            'jupiter_blog_4_col_categories_control',
            array(
                'settings' => 'jupiter_blog_4_col_categories_setting',
                'label'    => __( 'Select Post Categories', 'jupiter-blog' ),
                'section'  => 'jupiter_blog_homepage_sections', // Enter the name of your own section
                'type'     => 'multiple-select', // The $type in our class
                'choices'  => jupiter_blog_project_types(), // Your choices
                'active_callback' => 'jupiter_blog_is_4_col_section_enabled'
            )
        )
    );
    
    // Enable Loop Section?
	$wp_customize->add_setting('jupiter_blog_show_loop_section', array(
		'default'    => 1,
        'sanitize_callback' => 'absint',
	));
    
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'jupiter_blog_show_loop_section',
            array(
                'label'     => __('Enable Loop Section', 'jupiter-blog'),
                'section'   => 'jupiter_blog_homepage_sections',
                'settings'  => 'jupiter_blog_show_loop_section',
                'type'      => 'checkbox',
            )
        )
    );

    // Loop Section Info
    $wp_customize->add_setting( 'jupiter_blog_category_loop_info_setting', array(
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'jupiter_blog_category_loop_info_control', array(
        'description'     => __( "Loop section displays most recent articles published.", "jupiter-blog" ),
        'section'         => 'jupiter_blog_homepage_sections',
        'settings'        => 'jupiter_blog_category_loop_info_setting',
        'type'            => 'hidden',
    ) ) );

}

add_action( 'customize_register', 'jupiter_blog_section_setup');

// Active Callbacks
function jupiter_blog_is_block_section_enabled() {
    if( get_theme_mod( "jupiter_blog_show_block_section", 1 ) ) {
        return true;
    }

    return false;
}

function jupiter_blog_is_4_col_section_enabled() {
    if( get_theme_mod( "jupiter_blog_show_4_col_section", 1 ) ) {
        return true;
    }

    return false;
}
