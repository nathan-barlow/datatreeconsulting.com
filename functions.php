<?php
/**
 * Make Function Pluggable
 *
 * Child Theme can have a function with the same name
 * That function can override this function
 * If the function does not exist use this function
 * Otherwise do nothing the function already exists
 */
if ( ! function_exists( 'nb_after_setup_theme' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function nb_after_setup_theme() {

          // Let WordPress manage the document title.
          add_theme_support( 'title-tag' );

          // Allow admin users add Featured Images
          add_theme_support( 'post-thumbnails' );

          // Define sizes for Featured Images
          add_image_size( 'card-small', 480, 270, true );
          add_image_size( 'card-medium', 600, 800, true );
          add_image_size( 'card-large', 1200, 800, true );

          // Output HTML5 style HTML
          add_theme_support( 'html5', array(
               'caption',
               'comment-form',
               'comment-list',
               'gallery',
               'search-form',)
          );


          // Register Navigation Menus.
          register_nav_menus(
               array(
                'nav-main-header-top' => 'Main Nav, Top of Header',
                'nav-main-footer' => 'Footer Nav Left, Lower Footer',
                'nav-academic-footer' => 'Footer Nav Right, Lower Footer'
               )
          );

          // Register and Enqueue JavaScript Files
          function nb_enqueue_scripts() {
               wp_enqueue_script( 'nb-script', get_template_directory_uri() . '/js/main.js', [], wp_get_theme()->get('Version'), true );
          }
          add_action( 'wp_enqueue_scripts', 'nb_enqueue_scripts' );

          // Register Enqueue CSS Files
          function nb_enqueue_styles() {
            // wp_enqueue_style( Handle                                 , Path to File, Dependencies ['handle'], Version Number, CSS Media Type )
              wp_enqueue_style('nb-style', get_template_directory_uri() . '/style.css', [] , wp_get_theme()->get('Version'), 'all');
          }
          add_action('wp_enqueue_scripts', 'nb_enqueue_styles');


          // Pagination function.
          function nb_paginate() {
             global $paged, $wp_query;
             $abignum = 999999999; //we need an unlikely integer
             $args = array(
                  'base' => str_replace( $abignum, '%#%', esc_url( get_pagenum_link( $abignum ) ) ),
                  'format' => '?paged=%#%',
                  'current' => max( 1, get_query_var( 'paged' ) ),
                  'total' => $wp_query->max_num_pages,
                  'show_all' => False,
                  'end_size' => 2,
                  'mid_size' => 2,
                  'prev_next' => True,
                  'prev_text' => __( '&lt;' ),
                  'next_text' => __( '&gt;' ),
                  'type' => 'list'
             );
             echo paginate_links( $args );
          }


          // Define sizes for Custom Header Image
          // Allow Admin users to set Custom Header Image.
          $custom_header_args = array(
              'width'         => 310,
              'height'        => 85,
              'default-image' => get_template_directory_uri() . '/images/logo.png',
              'uploads'       => true,
          );
          add_theme_support( 'custom-header', $custom_header_args );

          // Allow Admin users to set Custom Background Color/Image.
          add_theme_support( 'custom-background' );
    }
endif;
add_action( 'after_setup_theme', 'nb_after_setup_theme' );

/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function nb_widgets_init() {

    /**
    * Registering "sidebars"
    */

    $datatree_footer_sidebar = array(
        'name' => 'Footer',
        'id' => 'footer',
        'description' => 'Widgets placed here will go in the footer (mailing list and social links)',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
    );
    $datatree_mailing_list_sidebar = array(
        'name' => 'Mailing List',
        'id' => 'mailing_list',
        'description' => 'Widgets placed here will go anywhere that shows the mailing list form.',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
    );
    $datatree_recent_posts_sidebar = array(
        'name' => 'Recent Posts',
        'id' => 'recent_posts',
        'description' => 'Widgets placed here will go on the sidebar of every post.',
        'before_widget' => '<div class="recent-posts-widget">',
        'after_widget' => '</div>',
    );
    register_sidebar( $datatree_footer_sidebar );
    register_sidebar( $datatree_mailing_list_sidebar );
    register_sidebar( $datatree_recent_posts_sidebar );
}

add_action( 'widgets_init', 'nb_widgets_init' );
add_post_type_support( 'page', 'excerpt' );


/* Set up color palette in editor */
function nb_setup_theme_supported_features() {
    add_theme_support( 'editor-color-palette', array(
        array(
            'name'  => esc_attr__( 'main green', 'themeLangDomain' ),
            'slug'  => 'main-green',
            'color' => '#5d9943',
        ),
        array(
            'name'  => esc_attr__( 'light green', 'themeLangDomain' ),
            'slug'  => 'light-green',
            'color' => '#f3f9f1',
        ),
        array(
            'name'  => esc_attr__( 'dark green', 'themeLangDomain' ),
            'slug'  => 'dark-green',
            'color' => '#2d552d',
        ),
        array(
            'name'  => esc_attr__( 'black', 'themeLangDomain' ),
            'slug'  => 'black',
            'color' => '#000',
        ),
        array(
            'name'  => esc_attr__( 'grat', 'themeLangDomain' ),
            'slug'  => 'gray',
            'color' => '#959595',
        ),
        array(
            'name'  => esc_attr__( 'white', 'themeLangDomain' ),
            'slug'  => 'white',
            'color' => '#fff',
        ),
    ) );
}

add_action( 'after_setup_theme', 'nb_setup_theme_supported_features' );

function remove_author_url( $url, $id, $comment ) { 
    return ""; 
}
add_filter( 'get_comment_author_url', 'remove_author_url', 10, 3);

// Add custom post type "publication"
function create_posttype_publication() {
    register_post_type( 'publication',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Publication' ),
                'singular_name' => __( 'Publications' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'publication'),
            'show_in_rest' => true,
            'description' => "Here you will add any publications.",
            'menu_position' => 4,
            'menu_icon' => 'dashicons-book',
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'thumbnail', ),
            'capability_type'     => 'post',
            'taxonomies' => array('post_tag'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_publication' );

// Add custom post type "trees"
function create_posttype_tree() {
    register_post_type( 'tree',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Trees' ),
                'singular_name' => __( 'Tree' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'tree'),
            'show_in_rest' => true,
            'description' => "Here you will add any available trees.",
            'menu_position' => 4,
            'menu_icon' => 'dashicons-palmtree',
            'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'thumbnail', ),
            'capability_type'     => 'post',
            'taxonomies' => array('post_tag'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_tree' );

function tree_type_taxonomy() {
    // Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
  
  $labels = array(
    'name' => _x( 'Tree Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Tree Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Tree Types' ),
    'all_items' => __( 'All Tree Types' ),
    'parent_item' => __( 'Parent Tree Type' ),
    'parent_item_colon' => __( 'Parent Tree Type:' ),
    'edit_item' => __( 'Edit Tree Type' ), 
    'update_item' => __( 'Update Tree Type' ),
    'add_new_item' => __( 'Add New Tree Type' ),
    'new_item_name' => __( 'New Tree Type' ),
    'menu_name' => __( 'Tree Types' ),
  );
  
// Now register the taxonomy
  register_taxonomy('tree-type',array('tree'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tree-type' ),
  ));
}

// Hooking up our function to theme setup
add_action( 'init', 'tree_type_taxonomy', 0);

function dt_jetpack_share() {
    if(is_page( 13 )) {
        add_filter( 'sharing_show', '__return_false' );
    }
}

add_action( 'wp_head', 'dt_jetpack_share' );

// add a link to the WP Toolbar
function custom_toolbar_link($wp_admin_bar) {
    $args = array(
        'id' => 'site-guide',
        'title' => 'Website Guide', 
        'href' => '/editing-your-site',
    );
    $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_toolbar_link', 999);

// Removes or edits the 'Protected:' part from posts titles
add_filter( 'protected_title_format', 'remove_protected_text' );
function remove_protected_text() {
return __('%s');
}

?>