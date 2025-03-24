/**
 * Plugin Name: Easy Media Uploader
 * Plugin URI: http://guitarchordslyrics.com
 * Description: A WordPress plugin that provides a dynamic media uploader functionality. 
 *              It allows users to integrate a media uploader easily within the admin panel 
 *              and provides shortcode support for displaying uploaded media.
 * Version: 1.0
 * Author: Arif M.
 * Author URI: http://guitarchordslyrics.com
 * License: GNU GENERAL PUBLIC LICENSE
 *
 * Features:
 * - Enqueues custom CSS and JavaScript for the media uploader.
 * - Registers a custom post type "Media Uploader" with REST API support.
 * - Adds a custom meta box for generating and displaying shortcodes for uploaded media.
 * - Provides shortcodes for embedding uploaded media in posts or pages.
 * - Removes the editor from the custom post type to streamline the interface.
 *
 * Hooks:
 * - `admin_init`: Enqueues styles and scripts for the admin panel.
 * - `init`: Registers the custom post type and removes the editor support.
 * - `add_meta_boxes_{post_type}`: Adds a custom meta box for the "Media Uploader" post type.
 *
 * Functions:
 * - easy_media_uploader_enqueue(): Enqueues the plugin's CSS and JavaScript files.
 * - create_easyposttype(): Registers the "Media Uploader" custom post type.
 * - adding_custom_meta_boxes(): Adds a meta box for shortcode generation.
 * - cpt_form_site_Render(): Renders the content of the custom meta box.
 *
 * Usage:
 * - Use the generated shortcode `[e_img_{post_id}]` to display uploaded media in the frontend.
 * - Use the PHP function `EasyMedia('[e_img_{post_id}]')` to insert media dynamically in templates.
 */
<?php 
/*
Plugin Name: Easy Media Uploader
Plugin URI: http://guitarchordslyrics.com
Description: Utilizing the 'EasyMedia' function along with a string within the admin panel enables the quick integration of a dynamic media uploader anywhere with ease.
Version: 1.0
Author: Arif M.
Author URI: http://guitarchordslyrics.com
License: GNU GENERAL PUBLIC LICENSE
*/

// Define a constant to prevent direct access
define('EASY_MEDIA_UPLOAD', true);
// Prevent direct access to this file
if (!defined('EASY_MEDIA_UPLOAD')) {
    header('HTTP/1.0 403 Forbidden');
    exit; // Prevent direct access
}

// Include other plugin files
include_once(plugin_dir_path(__FILE__) . 'inc/easy-dynamic-media.php');
function easy_media_uploader_enqueue() {
    // $dir = plugin_dir_url(__FILE__);
	wp_enqueue_style( 'easy-media-uploader', plugin_dir_url(__FILE__) . 'assets/css/easy-media-upload.css' );
	wp_enqueue_script( 'easy-media-uploader', plugin_dir_url(__FILE__) . 'assets/js/easy-media-upload.js', array(), '1.0.0', true );
}
add_action( 'admin_init', 'easy_media_uploader_enqueue' );


// admin menu
// add_action('admin_menu', 'esy_media_uploader_menu');

//     function esy_media_uploader_menu() {
//         add_menu_page( 'Media Uploader', 'Media Uploader', 'manage_options', 'media-uploader', 'esy_media_uploader_init', 'dashicons-upload', 120 );
//     }
//     function esy_media_uploader_init() {
//         include __DIR__ . '/admin/inc/esy-media-admin.php';
//     }

//     function get_category_id( $cat_name ) {
//         $term = get_term_by( 'name', $cat_name, 'categories' );
//         return $term->term_id;
//     }



// Our custom post type function
add_action( 'init', 'create_easyposttype' );
function create_easyposttype() {
  
    register_post_type( 'Media Uploader',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Media Uploader' ),
                'singular_name' => __( 'Media' )
            ),
            'menu_icon' => 'dashicons-upload',
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'easy-media-uploader'),
            'show_in_rest' => true,
  
        )
    );
}

$cpt_public_slug = "mediauploader";
add_action( 'add_meta_boxes_' . $cpt_public_slug, 'adding_custom_meta_boxes' );
// add_action( 'save_post', 'save_metabox' , 10, 2 );

function adding_custom_meta_boxes(){
    global $cpt_public_slug;
    add_meta_box(
        'plugin-site',
        __( 'Image Shortcode', 'text_domain' ),
        'cpt_form_site_Render',
        $cpt_public_slug,
        'normal',
        'high'
    );
}

function cpt_form_site_Render(){
    global $post;

    $post_meta = get_post_meta($post->ID); ?>
    <br>
    <p><b>Use shortcode in admin to insert image</b></p>
    <code><span>&lt;</span>?php EasyMedia('[e_img_<?php echo get_the_ID() ?>]'); ?<span>&gt;</span></code>
    <p><b>Or</b></p>
    <?php 

        $post_types = get_post_types(); ?>
        <p>Assign to post Type</p>
         <select name="" id=""> 
        <?php
        foreach ( $post_types as $post_type ) { ?>
            <option value="<?php echo $post_type ?>"><?php echo $post_type ?></option>
        <?php } ?>
        </select>
        <p><b>To show the image in frontend</b></p>
        <code><span>&lt;</span>?php echo wp_get_attachment_image(get_option('e_img_<?php echo get_the_ID() ?>')); ?<span>&gt;</span></code>
        <p><b>Or</b></p>
        <p>Shortcode</p>
        <code>[e_img_<?php echo get_the_ID() ?>]</code>
        <br>
        <?php
}


// Remove editor from the custom post type
add_action( 'init', function() {
    remove_post_type_support( 'mediauploader', 'editor' );
}, 99);