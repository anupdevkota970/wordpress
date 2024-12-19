<?php

/**
 * Template part for displaying post theme functions
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Jupiter Blog
 * @since Jupiter Blog 1.0
 */

/**************************************************************************************************************
 * Loads google fonts to the theme
 * Thanks to themeshaper.com
 ***********************************************************************************************************/

if (!function_exists('jupiter_blog_fonts_url')) :

  function jupiter_blog_fonts_url() {
    $jupiter_blog_fonts_url   = '';
    $jupiter_blog_one         = _x('on', 'Libre Baskerville font: on or off', 'jupiter-blog');
    $jupiter_blog_two         = _x('on', 'Rubik font: on or off', 'jupiter-blog');

    if ('off' !== $jupiter_blog_one || 'off' !== $jupiter_blog_two) {
      $jupiter_blog_font_families = array();

      if ('off' !== $jupiter_blog_one) {
        $jupiter_blog_font_families[] = 'Libre Baskerville:wght@400;700';
      }

      if ('off' !== $jupiter_blog_two) {
        $jupiter_blog_font_families[] = 'Rubik:wght@300;400;800';
      }
    }

    $jupiter_blog_query_args = array(
      'family' => urlencode(implode('|', $jupiter_blog_font_families)),
      'subset' => urlencode('cyrillic-ext,cyrillic,vietnamese,latin-ext,latin')
    );

    $jupiter_blog_fonts_url = add_query_arg($jupiter_blog_query_args, 'https://fonts.googleapis.com/css');

    return esc_url_raw($jupiter_blog_fonts_url);
  }

endif;


/*********************************************************************************************************
 *  Adds a span tag with dropdown icon after the unordered list
 *  that has a sub menu on the mobile menu.
 ********************************************************************************************************/

class Jupiter_Blog_Dropdown_Toggle_Walker_Nav_Menu extends Walker_Nav_Menu {
  function start_lvl(&$jupiter_blog_output, $jupiter_blog_depth = 0, $jupiter_blog_args = array()) {
    $jupiter_blog_indent = str_repeat("\t", $jupiter_blog_depth);
    if ('header_menu' == $jupiter_blog_args->theme_location) {
      $jupiter_blog_output .= '<div class="submenu-toggle"><a href="#"><i class="icofont-rounded-down"></i></a></div>';
    }
    $jupiter_blog_output .= "\n$jupiter_blog_indent<ul class=\"sub-menu\">\n";
  }
}

/****************************************************************************
 *  Custom Excerpt Length
 ****************************************************************************/

function jupiter_blog_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);

  if (count($excerpt) >= $limit) {
    array_pop($excerpt);
    $excerpt = implode(" ", $excerpt) . '...';
  } else {
    $excerpt = implode(" ", $excerpt);
  }

  $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

  echo $excerpt;
}
/*********************************************************************************************************
 * Estimated reading time
 *********************************************************************************************************/

/* Word read count */
function jupiter_blog_post_read_time($post_id) {

  // get the post content
  $content = get_post_field('post_content', $post_id);

  // count the words
  $word_count = str_word_count(strip_tags($content));

  // reading time itself
  $readingtime = ceil($word_count / 200);

  if ($readingtime == 1) {
    $timer = esc_html__(" Minute read", 'jupiter-blog');
  } else {
    $timer = esc_html__(" Minutes read", 'jupiter-blog');
  }

  // I'm going to print 'X minute read' above my post
  $totalreadingtime = $readingtime . $timer;
  echo ($totalreadingtime);
}


/*********************************************************************************************************
 * Pagination
 *********************************************************************************************************/

function jupiter_blog_number_pagination() {
  global $wp_query;
  $big = 9999999; // need an unlikely integer
  echo paginate_links(array(
    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
    'format' => '?paged=%#%',
    'current' => max(1, get_query_var('paged')),
    'prev_next'    => true,
    'prev_text'    => __('&#8203;', 'jupiter-blog'),
    'next_text'    => __('&#8203;', 'jupiter-blog'),
    'add_args'     => false,
    'total' => $wp_query->max_num_pages
  ));
}


/****************************************************************************
 *  Adds Category Color Picker Field
 ****************************************************************************/
/* Add new colorpicker field to "Add new Category" screen */
function jupiter_blog_colorpicker_field_add_new_category($taxonomy) {
?>
  <div class="form-field term-colorpicker-wrap">
    <label for="term-colorpicker"><?php echo esc_html_e('Select Category Color', 'jupiter-blog'); ?></label>
    <input name="_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker" />
    <p><?php esc_html_e('Select Specific color for this category', 'jupiter-blog'); ?></p>
  </div>
<?php
}
add_action('category_add_form_fields', 'jupiter_blog_colorpicker_field_add_new_category');

/* Add new colopicker field to "Edit Category" screen */
function jupiter_blog_colorpicker_field_edit_category($term) {
  $color = get_term_meta($term->term_id, '_category_color', true);
  $color = (!empty($color)) ? "#{$color}" : '#f6727f';
?>
  <tr class="form-field term-colorpicker-wrap">
    <th scope="row"><label for="term-colorpicker"><?php esc_html_e('Select Category Color', 'jupiter-blog'); ?></label></th>
    <td>
      <input name="_category_color" value="<?php echo esc_attr($color); ?>" class="colorpicker" id="term-colorpicker" />
      <p class="description"><?php esc_html_e('Select Specific color for this category', 'jupiter-blog'); ?></p>
    </td>
  </tr>
  <?php
}
add_action('category_edit_form_fields', 'jupiter_blog_colorpicker_field_edit_category');   // Variable Hook Name

/* Term Metadata - Save Created and Edited Term Metadata */
function jupiter_blog_save_termmeta($term_id) {

  // Save term color if possible
  if (isset($_POST['_category_color']) && !empty($_POST['_category_color'])) {
    $cat_color = sanitize_text_field(wp_unslash($_POST['_category_color']));
    update_term_meta($term_id, '_category_color', sanitize_hex_color_no_hash($cat_color));
  } else {
    delete_term_meta($term_id, '_category_color');
  }
}
add_action('created_category', 'jupiter_blog_save_termmeta');  // Variable Hook Name
add_action('edited_category',  'jupiter_blog_save_termmeta');  // Variable Hook Name


/* Enqueue wp-color-picker */
function jupiter_blog_category_colorpicker_enqueue($taxonomy) {
  if (isset($_GET['taxonomy'])) {
    // Colorpicker Scripts
    wp_enqueue_script('wp-color-picker');

    // Colorpicker Styles
    wp_enqueue_style('wp-color-picker');
  }
}

add_action('admin_enqueue_scripts', 'jupiter_blog_category_colorpicker_enqueue');

/* Add Display Color Picker */
function jupiter_blog_the_category_colors() {

  $categories = get_the_category();

  $separator = '';
  $output = '';
  if ($categories) {
  ?>
    <div class="ct-categories">
      <?php
      foreach ($categories as $category) {
        $color = get_term_meta($category->term_id, '_category_color', true);
        $color = (!empty($color)) ? "#{$color}" : '#f6727f';

        /* translators: %s: Category name */
        $output .= '<span class="ct-category"><a style="color: ' .  $color . '; " href="' . esc_url(get_category_link($category->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", 'jupiter-blog'), $category->name)) . '">' . $category->cat_name . '</a></span>' . $separator;
      }
      echo trim($output, $separator);
      ?>
    </div>
    <?php
  }
}

/****************************************************************************
 *  Multi Select  Categories
 ****************************************************************************/

/**
 * Multiselect option for WP Customizer
 *
 * @param $wp_customize
 */
add_action('customize_register', __NAMESPACE__ . '\\jupiter_blog_multiselect_customize_register');
function jupiter_blog_multiselect_customize_register($wp_customize) {
  /**
   * Multiple select customize control class.
   */
  class Jupiter_Blog__Customize_Control_Multiple_Select extends \WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     */
    public $type = 'multiple-select';

    /**
     * Displays the multiple select on the customize screen.
     */
    public function render_content() {

      if (empty($this->choices)) {
        return;
      }
    ?>
      <label>
        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
        <select <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
          <?php
          foreach ($this->choices as $value => $label) {
            $selected = '';
            if (is_array($this->value())) {
              $selected = (in_array($value, $this->value())) ? selected(1, 1, false) : '';
            }
            echo '<option value="' . esc_attr($value) . '"' . $selected . '>' . $label . '</option>';
          }
          ?>
        </select>
      </label>
<?php }
  }
}

/**
 * Get all categories
 * 
 * @return array
 */
function jupiter_blog_project_types() {
  $cats    = array();
  $cats[0] = __('Filter by Latest Posts', 'jupiter-blog');
  foreach (get_categories() as $categories => $category) {
    $cats[$category->term_id] = $category->name;
  }

  return $cats;
}

/**
 * Validate the options against the existing categories
 *
 * @param  string[] $input
 *
 * @return string
 */
function jupiter_blog_project_types_sanitize($input) {
  $valid = jupiter_blog_project_types();

  foreach ($input as $value) {
    if (!array_key_exists($value, $valid)) {
      return [];
    }
  }

  return $input;
}
