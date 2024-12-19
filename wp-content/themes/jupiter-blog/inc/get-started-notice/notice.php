<?php

/*******************************************************************************
 *  Upgrade to Pro notice
 *******************************************************************************/

function jupiter_blog_set_transient() {
    // Transient expires in 12 hours
    set_transient('jupiter_blog_hide_pro_notice', true, 12 * HOUR_IN_SECONDS);
}
add_action('after_switch_theme', 'jupiter_blog_set_transient');

/**
 * AJAX handler to store the state of dismissible notices.
 */
add_action('wp_ajax_ct_pro_notice', 'jupiter_blog_ajax_pro_notice_handler');
function jupiter_blog_ajax_pro_notice_handler() {
    if (isset($_POST['type'])) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field(wp_unslash($_POST['type']));
        // Store it in the options table
        update_option('dismissed-' . $type, TRUE);
    }
}

/**
 * Pro Upgrade Notice
 */
add_action('admin_notices', 'jupiter_blog_pro_notice');
function jupiter_blog_pro_notice() {
    $theme = wp_get_theme();
    $theme_name = esc_html($theme->get('Name'));

    if (!get_option('dismissed-pro_notice', FALSE) && (get_transient('jupiter_blog_hide_pro_notice') === false)) {
?>
        <div class="notice notice-success notice-pro-notice is-dismissible pro-notice" data-notice="pro_notice">
            <h2><?php _e('LIMITED OFFER: Get 20% Off on Jupiter Blog Pro - Use Promo Code: FLAT20', 'jupiter-blog'); ?></h2>
            <p><?php _e('Get the best out of your blog with Jupiter Blog Pro! Jupiter Blog pro offers <b>Dark Mode</b>, Customizable typography, Advanced Slider settings, Optimized SEO and many more fearures. You will also get Premium support for your theme.', 'jupiter-blog'); ?></p>
            <a href="https://www.crafthemes.com/theme/jupiter-blog-pro" target="_blank" style="margin-bottom: 18px;display: block;"><button id="buy-pro-btn" type="button" class="button button-primary"><?php _e('Upgrade to Pro!', 'jupiter-blog'); ?></button></a>
        </div>
    <?php
    }
}

/*******************************************************************************
 *  Get Started Notice
 *******************************************************************************/

/**
 * AJAX handler to store the state of dismissible notices.
 */
add_action('wp_ajax_ct_get_started', 'jupiter_blog_ajax_notice_handler');
function jupiter_blog_ajax_notice_handler() {
    if (isset($_POST['type'])) {
        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
        $type = sanitize_text_field(wp_unslash($_POST['type']));
        // Store it in the options table
        update_option('dismissed-' . $type, TRUE);
    }
}

/**
 * Get Started Notice
 */
add_action('admin_notices', 'jupiter_blog_hook_admin_notice');
function jupiter_blog_hook_admin_notice() {
    $theme = wp_get_theme();
    $theme_name = esc_html($theme->get('Name'));

    // Check if it's been dismissed...
    if (!get_option('dismissed-get_started', FALSE)) {
        // Added the class "notice-get-started-class" so jQuery pick it up and pass via AJAX,
        // and added "data-notice" attribute in order to track multiple / different notices
        // multiple dismissible notice states 
    ?>
        <style>
            .ct-theme-screenshot {
                float: left;
                margin: 10px 20px 10px 0;
            }

            .ct-theme-screenshot {
                float: left;
                margin: 10px 20px 10px 0;
            }

            .ct-theme-screenshot img {
                width: 210px;
            }

            .ct-theme-notice-content h2 {
                line-height: 1.4;
            }

            .clearfix {
                content: "";
                display: table;
                clear: both;
            }

            .ct-push-down {
                padding-top: 15px;
                display: inline-block;
                padding-left: 8px;
            }

            .ct-button-padding.updating-message::before {
                margin-top: 12px;
            }
        </style>
        <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
            <div class="crafthemes-getting-started-notice clearfix">
                <div class="ct-theme-screenshot">
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/screenshot.png" class="screenshot" alt="<?php esc_attr_e('Theme Screenshot', 'jupiter-blog'); ?>" />
                </div><!-- /.ct-theme-screenshot -->
                <div class="ct-theme-notice-content">
                    <h2 class="ct-notice-h2">
                        <?php
                        /* translators: %1$s: Theme Name %2$s: Anchor link end %3$s: Anchor link end */
                        printf(
                            esc_html__('Thank you for choosing %1$s. Please proceed towards the %2$sWelcome page%3$s and give us the privilege to serve you.', 'jupiter-blog'),
                            $theme_name,
                            '<a href="' . esc_url(admin_url('themes.php?page=theme-info.php')) . '">',
                            '</a>'
                        );
                        ?>
                    </h2>

                    <p class="plugin-install-notice"><?php esc_html_e('Clicking the button below will install and activate the Crafthemes demo import plugin.', 'jupiter-blog') ?></p>

                    <?php  /* translators: 1: Theme Name */ ?>
                    <a class="jquery-btn-get-started button button-primary button-hero ct-button-padding" href="#" data-name="" data-slug=""><?php printf(esc_html__('Get started with %1$s', 'jupiter-blog'), $theme_name); ?></a><span class="ct-push-down">
                        <?php
                        /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                        printf(
                            'or %1$sCustomize theme%2$s</a></span>',
                            '<a href="' . esc_url(admin_url('customize.php')) . '">',
                            '</a>'
                        );
                        ?>
                </div><!-- /.ct-theme-notice-content -->
            </div>
        </div>
<?php }
}

/*******************************************************************************
 *  Plugin Installer
 *******************************************************************************/

add_action('wp_ajax_install_act_plugin', 'jupiter_blog_install_plugin');

function jupiter_blog_install_plugin() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    if (!file_exists(WP_PLUGIN_DIR . '/crafthemes-demo-import')) {
        $api = plugins_api('plugin_information', array(
            'slug'   => sanitize_key(wp_unslash('crafthemes-demo-import')),
            'fields' => array(
                'sections' => false,
            ),
        ));

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader($skin);
        $result   = $upgrader->install($api->download_link);
    }

    // Activate plugin.
    if (current_user_can('activate_plugin')) {
        $result = activate_plugin('crafthemes-demo-import/crafthemes-demo-import.php');
    }
}

/*******************************************************************************
 *  Custom Plugin Installer
 *******************************************************************************/
add_action('wp_ajax_install_act_plugin_custom', 'jupiter_blog_install_plugin_custom');

function jupiter_blog_install_plugin_custom() {
    /**
     * Install Plugin.
     */
    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

    $plugin_name = '';
    if (isset($_POST['plugin'])) {
        $plugin_name = sanitize_text_field(wp_unslash($_POST['plugin']));
    }

    $api = plugins_api('plugin_information', array(
        'slug'   => sanitize_key(wp_unslash($plugin_name)),
        'fields' => array(
            'sections' => false,
        ),
    ));

    // Install plugin if not installed
    if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_name)) {
        if (strpos($plugin_name, 'premium')) {
            $premium_plugin_url = 'https://www.crafthemes.com/xml/eae/update/' . $plugin_name . '.zip';
            $upgrader = new Plugin_Upgrader();
            $result = $upgrader->install($premium_plugin_url);
        } else {
            $skin     = new WP_Ajax_Upgrader_Skin();
            $upgrader = new Plugin_Upgrader($skin);
            $result   = $upgrader->install($api->download_link);
        }
    }

    // Activate plugin
    if (strpos($plugin_name, 'premium')) {
        if (current_user_can('activate_plugin') && is_plugin_inactive($plugin_name . '/' . $plugin_name . '.php')) {
            $eae_free_slug = str_replace('-premium', '', $plugin_name);
            activate_plugin($plugin_name . '/' . $plugin_name . '.php');
        }
    } else {
        $install_status = install_plugin_install_status($api);
        // If user can activate plugin and if the plugin is not active
        if (current_user_can('activate_plugin', $install_status['file']) && is_plugin_inactive($install_status['file'])) {
            $result = activate_plugin($install_status['file']);

            if (is_wp_error($result)) {
                $status['errorCode']    = $result->get_error_code();
                $status['errorMessage'] = $result->get_error_message();
                wp_send_json_error($status);
            }
        }
    }
}

/*******************************************************************************
 *  Enqueue script
 *******************************************************************************/

if (!function_exists('jupiter_blog_getting_started_admin_scripts')) :
    function jupiter_blog_getting_started_admin_scripts() {
        wp_enqueue_media();
        wp_enqueue_script('jupiter-blog-jquery-getting-started-script', get_template_directory_uri() . '/inc/get-started-notice/jquery-admin-ajax-call.js', array('jquery'), '', true);
        wp_localize_script(
            'jupiter-blog-jquery-getting-started-script',
            'ct_ajax_object',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('jupiter_blog_gstarted_nonce')
            )
        );
    }
endif;
add_action('admin_enqueue_scripts', 'jupiter_blog_getting_started_admin_scripts');
add_action('customize_controls_enqueue_scripts', 'jupiter_blog_getting_started_admin_scripts');
