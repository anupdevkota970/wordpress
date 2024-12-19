<?php

/*******************************************************************************
 *  Adds theme page of ( About Theme )
 *******************************************************************************/

function jupiter_blog_admin_menu() {
    $menus = $GLOBALS['menu'];
    $priority = array_filter($menus, function ($item) {
        return 'themes.php' === $item[2];
    });
    $priority = !empty($priority) && 1 === count($priority) ? key($priority) - 1 : null;

    add_menu_page(
        __('Jupiter Blog', 'jupiter-blog'),
        __('Jupiter Blog', 'jupiter-blog'),
        'edit_theme_options',
        'theme-info.php',
        'jupiter_blog_about',
        'dashicons-admin-customizer',
        $priority
    );
}
add_action('admin_menu', 'jupiter_blog_admin_menu');

function jupiter_blog_about() {

    $theme = wp_get_theme();
    $theme_name = esc_html($theme->get('Name'));
    $theme_description = $theme->get('Description');
    $theme_user = wp_get_current_user();
    $theme_slug = basename(get_stylesheet_directory());
    $premium_url = "https://www.crafthemes.com/theme/jupiter-blog-pro/";
?>

    <div class="container about-theme">
        <div class="row ct-screenshot">
            <div class="twelve columns clearfix">
                <div class="ct-welcome-area">
                    <h1><?php printf(esc_html__('Welcome to Jupiter Blog', 'jupiter-blog')); ?></h1>
                    <p><?php echo esc_html($theme_description); ?></p>
                </div>
            </div><!-- /.apex-desh-hl -->
        </div><!-- /.row -->
    </div>

    <div class="container about-theme">
        <div class="row ct-screenshot">
            <div class="row">
                <div class="twelve columns about-title">
                    <h1><?php printf(esc_html__('Import Pre Built Theme Demos!', 'jupiter-blog')); ?></h1>
                </div>
            </div>

            <div class="row">
                <div class="four columns ct-img-col">
                    <img class="ct-bordered" src="<?php echo esc_url("https://dc.crafthemes.com/jupiter-blog/free/screenshot.webp"); ?>" alt="Demo Image">
                    <div class="ct-theme-options">
                        <p class="ct-demo-text"><?php esc_html_e('Free Demo', 'jupiter-blog'); ?></p>
                        <div class="ct-theme-actions">
                            <a class="button ct-btn-preview" href="<?php echo esc_url("https://crafthemes-demo.click/jupiter-blog/"); ?>" target="_blank"><?php esc_html_e('Live Preview', 'jupiter-blog'); ?></a>
                            <a class="jquery-btn-get-started jquery-btn-import button button-primary" href="#" data-name="" data-slug=""><?php esc_html_e('Import Demo', 'jupiter-blog'); ?></a>
                        </div>
                    </div>
                </div>

                <div class="four columns ct-img-col">
                    <img class="ct-bordered" src="<?php echo esc_url("https://dc.crafthemes.com/jupiter-blog/pro-default/screenshot.webp"); ?>" alt="Demo Image">
                    <div class="ct-theme-options">
                        <p class="ct-demo-text"><?php esc_html_e('Pro Default', 'jupiter-blog'); ?></p>
                        <div class="ct-theme-actions">
                            <a class="button ct-btn-preview" href="<?php echo esc_url("https://www.crafthemes-demo.click/jupiter-blog-premium-two/"); ?>" target="_blank"><?php esc_html_e('Live Preview', 'jupiter-blog'); ?></a>
                            <a class="button button-primary" href="<?php echo esc_url($premium_url); ?>" data-name="" data-slug=""><?php esc_html_e('Buy Premium', 'jupiter-blog'); ?></a>
                        </div>
                    </div>
                </div>

                <div class="four columns ct-img-col">
                    <img class="ct-bordered" src="<?php echo esc_url("https://dc.crafthemes.com/jupiter-blog/pro-banner/screenshot.webp"); ?>" alt="Demo Image">
                    <div class="ct-theme-options">
                        <p class="ct-demo-text"><?php esc_html_e('Pro Banner', 'jupiter-blog'); ?></p>
                        <div class="ct-theme-actions">
                            <a class="button ct-btn-preview" href="<?php echo esc_url("https://crafthemes-demo.click/jupiter-blog-premium/"); ?>" target="_blank"><?php esc_html_e('Live Preview', 'jupiter-blog'); ?></a>
                            <a class="button button-primary" href="<?php echo esc_url($premium_url); ?>" data-name="" data-slug=""><?php esc_html_e('Buy Premium', 'jupiter-blog'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container about-theme">
        <div class="row ct-screenshot">
            <div class="twelve columns clearfix">
                <div class="ct-welcome-area about-title">
                    <h1><?php printf(esc_html__('Comparison between Free and Pro Version', 'jupiter-blog')); ?></h1>
                    <p><?php esc_html_e('All our themes are search engine optimized & have an unmatchable page speed.
              Amazing customer support is our number one priority.', 'jupiter-blog'); ?></p>
                </div>
            </div><!-- /.apex-desh-hl -->

            <div class="twelve columns">
                <div class="eae-ct-container">
                    <table class="comparison-table">
                        <tbody>
                            <tr>
                                <th class="empty-cell comparison-table-tfeatures"></th>
                                <th class="comparison-table-free eae-center-td">
                                    <?php esc_html_e('FREE', 'jupiter-blog'); ?></th>
                                <th class="comparison-table-pro eae-center-td">
                                    <?php esc_html_e('PREMIUM', 'jupiter-blog'); ?></th>
                            </tr>
                            <tr class="comparison-table-row">
                                <td class="comparison-table-heading"><?php esc_html_e('Logo Upload', 'jupiter-blog'); ?>
                                </td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row">
                                <td class="comparison-table-heading"><?php esc_html_e('Color Changes', 'jupiter-blog'); ?>
                                </td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Homepage Slider', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Footer Widgets', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading"><?php esc_html_e('Search Icon', 'jupiter-blog'); ?>
                                </td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Social Share Buttons', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row">
                                <td class="comparison-table-heading"><?php esc_html_e('Dark Mode', 'jupiter-blog'); ?>
                                </td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Premium Customizer Options', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row">
                                <td class="comparison-table-heading"><?php esc_html_e('Intro Header', 'jupiter-blog'); ?>
                                </td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Newsletter Section', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Advanced Slider Settings', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Advanced Homepage Customization', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Advanced Single Post Settings', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Instagram Feeds', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Sidebar Options', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Advanced Sidebar Settings', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Easy Google Fonts (650+)', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Advanced Typography', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Button Bar Customization', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Advanced Footer Customization', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Remove Footer Credits', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-row ">
                                <td class="comparison-table-heading">
                                    <?php esc_html_e('Premium Support', 'jupiter-blog'); ?></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-no-alt"></span></td>
                                <td class="eae-center-td"><span class="dashicons dashicons-yes"></span></td>
                            </tr>
                            <tr class="comparison-table-footer">
                                <td></td>
                                <td class="comparison-table-free"></td>
                                <td class="comparison-table-pro"> <a href="<?php echo esc_url($premium_url); ?>" class="eae-ct-buy-link"><?php esc_html_e('BUY NOW', 'jupiter-blog'); ?></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="ct-screenshot">
            <div class="ct-welcome-upgrade-box">
                <h3><?php esc_html_e('Upgrade To Premium Version (14 Days Money Back Guarantee)', 'jupiter-blog') ?></h3>
                <p><?php esc_html_e('With Jupiter Blog Premium you can create a beautiful website. Further if you want to unlock more possibilities then upgrade to the premium version, Try the Premium version and check if it fits your need or not. If not, we have 14 days money-back guarantee.', 'jupiter-blog'); ?>
                </p>
                <a class="upgrade-button" href="<?php echo esc_url($premium_url); ?>" target="_blank"><?php esc_html_e('Upgrade Now', 'jupiter-blog'); ?></a>
            </div><!-- /.ct-welcome-upgrade-box -->
        </div><!-- /.ct-screenshot -->
    </div><!-- /.container about-writer -->

<?php
}
